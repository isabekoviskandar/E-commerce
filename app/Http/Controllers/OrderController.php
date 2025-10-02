<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Services\TelegramService;
use Illuminate\Http\Request;
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

        $order = \App\Models\Order::create([
            'session_id' => session()->getId(),
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'address'    => $request->address,
            'phone'      => $request->phone,
            'total'      => $total,
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        $cart->items()->delete();

        // ✅ Send order info to Telegram
        $message = "<b>🛒 New Order Received!</b>\n\n"
            . "👤 Customer: {$order->first_name} {$order->last_name}\n"
            . "📞 Phone: {$order->phone}\n"
            . "📍 Address: {$order->address}\n"
            . "💰 Total: {$order->total}\n\n"
            . "🛍️ Items:\n";

        foreach ($order->items as $item) {
            $message .= "- {$item->product->name_uz} x {$item->quantity} = {$item->price}\n";
        }

        Log::info($message);
        TelegramService::sendMessage($message);

        return redirect()->route('store', ['locale' => $locale, 'order' => $order->id]);
    }
}
