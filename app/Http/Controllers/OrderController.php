<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $cart = Cart::where('session_id', $sessionId)->first();
        $cartItems = $cart ? $cart->items()->with('product')->get() : collect();

        return view('checkout', compact('cartItems'));
    }

    public function placeOrder(Request $request, $locale)
    {
        $cart = \App\Models\Cart::where('session_id', session()->getId())
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index', ['locale' => $locale])
                ->with('error', 'Cart is empty!');
        }

        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        // Normalize phone and find existing user
        $normalizedPhone = preg_replace('/[^0-9]/', '', $request->phone);
        if (strlen($normalizedPhone) === 9) {
            $normalizedPhone = '998' . $normalizedPhone;
        }

        $existingOrder = \App\Models\Order::where(function ($query) use ($normalizedPhone) {
            $query->where('phone', $normalizedPhone)
                ->orWhere('phone', 'LIKE', '%' . substr($normalizedPhone, -9))
                ->orWhere('phone', '+' . $normalizedPhone);
        })
            ->whereNotNull('chat_id')
            ->latest()
            ->first();

        $order = \App\Models\Order::create([
            'session_id' => session()->getId(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone' => $normalizedPhone,
            'total' => $total,
            'chat_id' => $existingOrder ? $existingOrder->chat_id : null,
            'language' => $existingOrder ? $existingOrder->language : 'uz'
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            $product = Product::find($item->product_id);
            if ($product) {
                $product->decrement('count', $item->quantity);
            }
        }

        $cart->items()->delete();

        // Send to admin channel
        $message = "<b>🛒 New Order Received!</b>\n\n"
            . "👤 Customer: {$order->first_name} {$order->last_name}\n"
            . "📞 Phone: {$order->phone}\n"
            . "📍 Address: {$order->address}\n"
            . "💰 Total: {$order->total}\n\n"
            . "🛍️ Items:\n";

        foreach ($order->items as $item) {
            $message .= "- {$item->product->name_uz} x {$item->quantity} = {$item->price}\n";
        }
        TelegramService::sendMessage($message);

        // Send notification to user if they have chat_id
        if ($order->chat_id) {
            $productsList = "";
            foreach ($order->items as $item) {
                $productsList .= "   • {$item->product->name_uz} x{$item->quantity} - "
                    . number_format($item->price * $item->quantity) . " so'm\n";
            }

            // Calculate delivery fee
            $deliveryFee = $total < 500000 ? 50000 : 0;
            $finalTotal = $total + $deliveryFee;

            // Delivery fee explanation message
            $deliveryText = $deliveryFee > 0
                ? "🚚 Yetkazib berish: " . number_format($deliveryFee) . " so'm\n" .
                "ℹ️ 500,000 so'mdan kam buyurtmalar uchun yetkazib berish 50,000 so'm\n"
                : "🚚 Yetkazib berish: BEPUL ✅\n" .
                "ℹ️ 500,000 so'm va undan ko'p buyurtmalar uchun yetkazib berish bepul!\n";

            $lang = $order->language ?? 'uz';

            $notificationMessage = "🆕 Yangi buyurtma yaratildi!\n\n" .
                "Order ID: #{$order->id}\n" .
                "👤 {$order->first_name} {$order->last_name}\n" .
                "📞 {$order->phone}\n" .
                "📍 {$order->address}\n\n" .
                "🛒 Mahsulotlar:\n{$productsList}\n" .
                "💰 Subtotal: " . number_format($total) . " so'm\n" .
                $deliveryText .
                "💵 Jami to'lov: " . number_format($finalTotal) . " so'm\n\n" .
                "📊 Status: To'lov kutilmoqda";

            // Add payment button
            $keyboard = [
                'inline_keyboard' => [[
                    ['text' => '💳 To\'lov qilish', 'callback_data' => "show_payment_{$order->id}"]
                ]]
            ];

            Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
                'chat_id' => $order->chat_id,
                'text' => $notificationMessage,
                'reply_markup' => json_encode($keyboard)
            ]);
        }

        return redirect()->away('https://t.me/abdushukur_tabib_bot');
    }
}
