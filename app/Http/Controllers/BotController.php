<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;

class BotController extends Controller
{
    private $translations = [
        'en' => [
            'welcome' => "🌍 Welcome! Please choose your language:",
            'language_changed' => "✅ Language changed to English",
            'share_phone' => "📱 Please share your phone number:",
            'phone_button' => "📱 Share phone number",
            'orders_found' => "✅ Order Found!",
            'order_id' => "Order ID",
            'total' => "Total",
            'status' => "Status",
            'send_payment' => "📸 Please send payment screenshot",
            'no_orders' => "❌ No pending orders found for this phone number.",
            'payment_received' => "✅ Payment screenshot received! Waiting for admin confirmation...",
            'no_pending' => "❌ No pending orders found. Please create an order first or contact support.",
            'payment_approved' => "✅ Your payment has been approved!",
            'order_confirmed' => "Your order is confirmed and will be processed soon.",
            'payment_rejected' => "❌ Your payment was not approved.",
            'contact_support' => "Please contact support or try again with a valid payment.",
            'approved' => "approved",
            'rejected' => "rejected",
            'created' => "created",
            'menu_orders' => "📦 My Orders",
            'menu_language' => "🌍 Change Language",
            'menu_back' => "🔙 Back to Menu",
            'order_history' => "📦 Your Order History:",
            'no_history' => "📭 You don't have any orders yet.",
            'order_details' => "Order Details"
        ],
        'ru' => [
            'welcome' => "🌍 Добро пожаловать! Пожалуйста, выберите язык:",
            'language_changed' => "✅ Язык изменен на Русский",
            'share_phone' => "📱 Пожалуйста, поделитесь своим номером телефона:",
            'phone_button' => "📱 Поделиться номером",
            'orders_found' => "✅ Заказ найден!",
            'order_id' => "ID заказа",
            'total' => "Итого",
            'status' => "Статус",
            'send_payment' => "📸 Пожалуйста, отправьте скриншот оплаты",
            'no_orders' => "❌ Не найдено ожидающих заказов для этого номера телефона.",
            'payment_received' => "✅ Скриншот оплаты получен! Ожидание подтверждения администратора...",
            'no_pending' => "❌ Ожидающих заказов не найдено. Пожалуйста, сначала создайте заказ или свяжитесь с поддержкой.",
            'payment_approved' => "✅ Ваш платеж одобрен!",
            'order_confirmed' => "Ваш заказ подтвержден и скоро будет обработан.",
            'payment_rejected' => "❌ Ваш платеж не был одобрен.",
            'contact_support' => "Пожалуйста, свяжитесь с поддержкой или попробуйте снова с действительным платежом.",
            'approved' => "одобрен",
            'rejected' => "отклонен",
            'created' => "создан",
            'menu_orders' => "📦 Мои Заказы",
            'menu_language' => "🌍 Изменить Язык",
            'menu_back' => "🔙 Назад в Меню",
            'order_history' => "📦 История Ваших Заказов:",
            'no_history' => "📭 У вас пока нет заказов.",
            'order_details' => "Детали Заказа"
        ],
        'uz' => [
            'welcome' => "🌍 Xush kelibsiz! Iltimos, tilni tanlang:",
            'language_changed' => "✅ Til O'zbek tiliga o'zgartirildi",
            'share_phone' => "📱 Iltimos, telefon raqamingizni ulashing:",
            'phone_button' => "📱 Telefon raqamni ulashish",
            'orders_found' => "✅ Buyurtma topildi!",
            'order_id' => "Buyurtma ID",
            'total' => "Jami",
            'status' => "Holat",
            'send_payment' => "📸 Iltimos, to'lov skrinshotini yuboring",
            'no_orders' => "❌ Ushbu telefon raqami uchun kutilayotgan buyurtmalar topilmadi.",
            'payment_received' => "✅ To'lov skrinshoti qabul qilindi! Admin tasdig'ini kutilmoqda...",
            'no_pending' => "❌ Kutilayotgan buyurtmalar topilmadi. Iltimos, avval buyurtma yarating yoki qo'llab-quvvatlash xizmatiga murojaat qiling.",
            'payment_approved' => "✅ To'lovingiz tasdiqlandi!",
            'order_confirmed' => "Buyurtmangiz tasdiqlandi va tez orada qayta ishlanadi.",
            'payment_rejected' => "❌ To'lovingiz tasdiqlanmadi.",
            'contact_support' => "Iltimos, qo'llab-quvvatlash xizmatiga murojaat qiling yoki haqiqiy to'lov bilan qayta urinib ko'ring.",
            'approved' => "tasdiqlangan",
            'rejected' => "rad etilgan",
            'created' => "yaratilgan",
            'menu_orders' => "📦 Mening Buyurtmalarim",
            'menu_language' => "🌍 Tilni O'zgartirish",
            'menu_back' => "🔙 Menyuga Qaytish",
            'order_history' => "📦 Buyurtmalar Tarixi:",
            'no_history' => "📭 Sizda hali buyurtmalar yo'q.",
            'order_details' => "Buyurtma Tafsilotlari"
        ]
    ];

    private function trans($key, $lang)
    {
        return $this->translations[$lang][$key] ?? $this->translations['en'][$key];
    }

    private function getMainMenuKeyboard($lang)
    {
        return [
            'keyboard' => [
                [
                    ['text' => $this->trans('menu_orders', $lang)],
                    ['text' => $this->trans('menu_language', $lang)]
                ]
            ],
            'resize_keyboard' => true
        ];
    }

    private function getLanguageKeyboard()
    {
        return [
            'inline_keyboard' => [
                [
                    ['text' => '🇬🇧 English', 'callback_data' => 'lang_en'],
                    ['text' => '🇷🇺 Русский', 'callback_data' => 'lang_ru']
                ],
                [
                    ['text' => '🇺🇿 O\'zbekcha', 'callback_data' => 'lang_uz']
                ]
            ]
        ];
    }

    private function getUserLanguage($chatId)
    {
        $user = Order::where('chat_id', $chatId)->first();
        return $user ? $user->language : 'en';
    }

    private function setUserLanguage($chatId, $language)
    {
        Order::updateOrCreate(
            ['chat_id' => $chatId],
            ['language' => $language]
        );
    }

    public function webhook(Request $request)
    {
        $data = $request->all();
        $token = env('TELEGRAM_BOT_TOKEN');
        $apiUrl = "https://api.telegram.org/bot{$token}/sendMessage";

        // Handle regular messages
        if (isset($data['message'])) {
            $chatId = $data['message']['chat']['id'];
            $text = $data['message']['text'] ?? '';
            $lang = $this->getUserLanguage($chatId);

            // /start command
            if ($text === '/start') {
                Http::post($apiUrl, [
                    'chat_id' => $chatId,
                    'text' => $this->trans('welcome', 'en'),
                    'reply_markup' => json_encode($this->getLanguageKeyboard())
                ]);
                return response()->json(['ok' => true]);
            }

            // Handle menu buttons
            if (strpos($text, $this->trans('menu_orders', $lang)) !== false || 
                strpos($text, '📦') === 0) {
                $this->showOrderHistory($chatId, $lang, $token);
                return response()->json(['ok' => true]);
            }

            if (strpos($text, $this->trans('menu_language', $lang)) !== false || 
                strpos($text, '🌍') === 0) {
                Http::post($apiUrl, [
                    'chat_id' => $chatId,
                    'text' => $this->trans('welcome', $lang),
                    'reply_markup' => json_encode($this->getLanguageKeyboard())
                ]);
                return response()->json(['ok' => true]);
            }

            // If user shares contact
            if (isset($data['message']['contact'])) {
                $phone = $data['message']['contact']['phone_number'];

                // Update user with phone number
                Order::updateOrCreate(
                    ['chat_id' => $chatId],
                    ['phone' => $phone]
                );

                // Update all orders with this phone to have chat_id
                Order::where('phone', $phone)->update(['chat_id' => $chatId]);

                // Fetch only orders with status 'created' for this phone
                $orders = Order::where('phone', $phone)
                    ->where('status', 'created')
                    ->latest()
                    ->get();

                if ($orders->count() > 0) {
                    foreach ($orders as $order) {
                        $message = "{$this->trans('orders_found', $lang)}\n\n" .
                            "{$this->trans('order_id', $lang)}: #{$order->id}\n" .
                            "👤 {$order->first_name} {$order->last_name}\n" .
                            "📍 {$order->address}\n" .
                            "📞 {$order->phone}\n" .
                            "💰 {$this->trans('total', $lang)}: {$order->total}\n" .
                            "📊 {$this->trans('status', $lang)}: {$this->trans($order->status, $lang)}\n\n" .
                            $this->trans('send_payment', $lang);

                        Http::post($apiUrl, [
                            'chat_id' => $chatId,
                            'text' => $message,
                            'reply_markup' => json_encode($this->getMainMenuKeyboard($lang))
                        ]);
                    }
                } else {
                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => $this->trans('no_orders', $lang),
                        'reply_markup' => json_encode($this->getMainMenuKeyboard($lang))
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
                        'text' => $this->trans('payment_received', $lang)
                    ]);
                } else {
                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => $this->trans('no_pending', $lang)
                    ]);
                }
            }
        }

        // Handle callback queries (language selection, approve/reject buttons)
        if (isset($data['callback_query'])) {
            $callbackId = $data['callback_query']['id'];
            $callbackData = $data['callback_query']['data'];
            $chatId = $data['callback_query']['message']['chat']['id'];
            $messageId = $data['callback_query']['message']['message_id'];

            // Language selection
            if (strpos($callbackData, 'lang_') === 0) {
                $selectedLang = substr($callbackData, 5);
                $this->setUserLanguage($chatId, $selectedLang);

                // Show phone sharing keyboard
                $keyboard = [
                    'keyboard' => [
                        [
                            [
                                'text' => $this->trans('phone_button', $selectedLang),
                                'request_contact' => true
                            ]
                        ]
                    ],
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true
                ];

                Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
                    'callback_query_id' => $callbackId,
                    'text' => $this->trans('language_changed', $selectedLang)
                ]);

                Http::post("https://api.telegram.org/bot{$token}/editMessageText", [
                    'chat_id' => $chatId,
                    'message_id' => $messageId,
                    'text' => $this->trans('language_changed', $selectedLang)
                ]);

                Http::post($apiUrl, [
                    'chat_id' => $chatId,
                    'text' => $this->trans('share_phone', $selectedLang),
                    'reply_markup' => json_encode($keyboard)
                ]);

                return response()->json(['ok' => true]);
            }

            // Order approval/rejection
            list($action, $orderId) = explode('_', $callbackData);
            $order = Order::find($orderId);

            if ($order) {
                $lang = $this->getUserLanguage($order->chat_id);

                if ($action === 'approve') {
                    $order->update(['status' => 'approved']);

                    Http::post($apiUrl, [
                        'chat_id' => $order->chat_id,
                        'text' => "{$this->trans('payment_approved', $lang)}\n\n" .
                            "{$this->trans('order_id', $lang)}: #{$order->id}\n" .
                            "{$this->trans('status', $lang)}: {$this->trans('approved', $lang)}\n\n" .
                            $this->trans('order_confirmed', $lang)
                    ]);

                    Http::post("https://api.telegram.org/bot{$token}/editMessageCaption", [
                        'chat_id' => $chatId,
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
                    $order->update(['status' => 'rejected']);

                    Http::post($apiUrl, [
                        'chat_id' => $order->chat_id,
                        'text' => "{$this->trans('payment_rejected', $lang)}\n\n" .
                            "{$this->trans('order_id', $lang)}: #{$order->id}\n" .
                            "{$this->trans('status', $lang)}: {$this->trans('rejected', $lang)}\n\n" .
                            $this->trans('contact_support', $lang)
                    ]);

                    Http::post("https://api.telegram.org/bot{$token}/editMessageCaption", [
                        'chat_id' => $chatId,
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

                Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
                    'callback_query_id' => $callbackId,
                    'text' => $action === 'approve' ? '✅ Order Approved' : '❌ Order Rejected'
                ]);
            }
        }

        return response()->json(['ok' => true]);
    }

    private function showOrderHistory($chatId, $lang, $token)
    {
        $apiUrl = "https://api.telegram.org/bot{$token}/sendMessage";
        
        $orders = Order::where('chat_id', $chatId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($orders->count() > 0) {
            $message = "{$this->trans('order_history', $lang)}\n\n";
            
            foreach ($orders as $order) {
                $message .= "━━━━━━━━━━━━━━━\n";
                $message .= "{$this->trans('order_id', $lang)}: #{$order->id}\n";
                $message .= "👤 {$order->first_name} {$order->last_name}\n";
                $message .= "📍 {$order->address}\n";
                $message .= "💰 {$this->trans('total', $lang)}: {$order->total}\n";
                $message .= "📊 {$this->trans('status', $lang)}: {$this->trans($order->status, $lang)}\n";
                $message .= "📅 {$order->created_at->format('d.m.Y H:i')}\n\n";
            }
        } else {
            $message = $this->trans('no_history', $lang);
        }

        Http::post($apiUrl, [
            'chat_id' => $chatId,
            'text' => $message,
            'reply_markup' => json_encode($this->getMainMenuKeyboard($lang))
        ]);
    }
}