<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;

class BotController extends Controller
{
    public function webhook(Request $request)
    {
        $data = $request->all();
        $token = env('TELEGRAM_BOT_TOKEN');
        $apiUrl = "https://api.telegram.org/bot{$token}/sendMessage";

        // Handle regular messages
        if (isset($data['message'])) {
            $chatId = $data['message']['chat']['id'];
            $text = $data['message']['text'] ?? '';

            // /start command
            if ($text === '/start') {
                $keyboard = [
                    'keyboard' => [
                        [
                            [
                                'text' => '📱 Share phone number',
                                'request_contact' => true
                            ]
                        ]
                    ],
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true
                ];

                Http::post($apiUrl, [
                    'chat_id' => $chatId,
                    'text' => "Welcome! Please share your phone number:",
                    'reply_markup' => json_encode($keyboard)
                ]);
            }

            // If user shares contact
            if (isset($data['message']['contact'])) {
                $phone = $data['message']['contact']['phone_number'];

                // Update all orders with this phone to have chat_id
                Order::where('phone', $phone)->update(['chat_id' => $chatId]);

                // Fetch only orders with status 'created' for this phone
                $orders = Order::where('phone', $phone)
                    ->where('status', 'created')
                    ->latest()
                    ->get();

                if ($orders->count() > 0) {
                    foreach ($orders as $order) {
                        $message = "✅ Order Found!\n\n" .
                            "Order ID: #{$order->id}\n" .
                            "👤 {$order->first_name} {$order->last_name}\n" .
                            "📍 {$order->address}\n" .
                            "📞 {$order->phone}\n" .
                            "💰 Total: {$order->total}\n" .
                            "📊 Status: {$order->status}\n\n" .
                            "📸 Please send payment screenshot";

                        Http::post($apiUrl, [
                            'chat_id' => $chatId,
                            'text' => $message
                        ]);
                    }
                } else {
                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => "❌ No pending orders found for this phone number."
                    ]);
                }
            }

            // If user sends photo (payment screenshot)
            if (isset($data['message']['photo'])) {
                $photo = end($data['message']['photo']); // Get highest resolution
                $fileId = $photo['file_id'];

                // Get user's latest order with status 'created'
                $order = Order::where('chat_id', $chatId)
                    ->where('status', 'created')
                    ->latest()
                    ->first();

                if ($order) {
                    // Forward photo to admin channel
                    $channelId = env('TELEGRAM_CHAT_ID');
                    Http::post("https://api.telegram.org/bot{$token}/sendPhoto", [
                        'chat_id' => $channelId,
                        'photo' => $fileId,
                        'caption' => "💳 Payment Screenshot\n\n" .
                            "Order ID: #{$order->id}\n" .
                            "👤 {$order->first_name} {$order->last_name}\n" .
                            "📞 {$order->phone}\n" .
                            "📍 {$order->address}\n" .
                            "💰 Total: {$order->total}\n" .
                            "📊 Status: {$order->status}",
                        'reply_markup' => json_encode([
                            'inline_keyboard' => [[
                                ['text' => '✅ Approve', 'callback_data' => "approve_{$order->id}"],
                                ['text' => '❌ Reject', 'callback_data' => "reject_{$order->id}"]
                            ]]
                        ])
                    ]);

                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => "✅ Payment screenshot received! Waiting for admin confirmation..."
                    ]);
                } else {
                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => "❌ No pending orders found. Please create an order first or contact support."
                    ]);
                }
            }
        }

        // Handle callback queries (approve/reject buttons)
        if (isset($data['callback_query'])) {
            $callbackId = $data['callback_query']['id'];
            $callbackData = $data['callback_query']['data'];
            $messageId = $data['callback_query']['message']['message_id'];
            $channelId = $data['callback_query']['message']['chat']['id'];

            list($action, $orderId) = explode('_', $callbackData);

            $order = Order::find($orderId);

            if ($order) {
                if ($action === 'approve') {
                    // Update order status to 'approved'
                    $order->update(['status' => 'approved']);

                    // Notify customer
                    Http::post($apiUrl, [
                        'chat_id' => $order->chat_id,
                        'text' => "✅ Your payment has been approved!\n\n" .
                            "Order ID: #{$order->id}\n" .
                            "Status: Approved\n\n" .
                            "Your order is confirmed and will be processed soon."
                    ]);

                    // Update admin message
                    Http::post("https://api.telegram.org/bot{$token}/editMessageCaption", [
                        'chat_id' => $channelId,
                        'message_id' => $messageId,
                        'caption' => "✅ APPROVED\n\n" .
                            "Order ID: #{$order->id}\n" .
                            "👤 {$order->first_name} {$order->last_name}\n" .
                            "📞 {$order->phone}\n" .
                            "📍 {$order->address}\n" .
                            "💰 Total: {$order->total}\n" .
                            "📊 Status: approved"
                    ]);
                } elseif ($action === 'reject') {
                    // Update order status to 'rejected'
                    $order->update(['status' => 'rejected']);

                    // Notify customer
                    Http::post($apiUrl, [
                        'chat_id' => $order->chat_id,
                        'text' => "❌ Your payment was not approved.\n\n" .
                            "Order ID: #{$order->id}\n" .
                            "Status: Rejected\n\n" .
                            "Please contact support or try again with a valid payment."
                    ]);

                    // Update admin message
                    Http::post("https://api.telegram.org/bot{$token}/editMessageCaption", [
                        'chat_id' => $channelId,
                        'message_id' => $messageId,
                        'caption' => "❌ REJECTED\n\n" .
                            "Order ID: #{$order->id}\n" .
                            "👤 {$order->first_name} {$order->last_name}\n" .
                            "📞 {$order->phone}\n" .
                            "📍 {$order->address}\n" .
                            "💰 Total: {$order->total}\n" .
                            "📊 Status: rejected"
                    ]);
                }

                // Answer callback query
                Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
                    'callback_query_id' => $callbackId,
                    'text' => $action === 'approve' ? '✅ Order Approved' : '❌ Order Rejected'
                ]);
            }
        }

        return response()->json(['ok' => true]);
    }
}
