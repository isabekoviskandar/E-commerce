<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

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
            'order_details' => "Order Details",
            'payment_method' => '💳 Choose the payment method',
            'humo' => "🏦 Humo (9860 1666 5364 4418)",
            'visa' => "💳 Visa (4738 7203 4457 8541)",
            'click' => "📱 Click (5614681626866978)",
            'product' => "Product",
            'price' => "Price",
            'menu_unpaid_orders' => 'Unpaid Orders',
            'no_unpaid_orders' => 'You have no unpaid orders.',
            'products' => 'Products',

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
            'order_details' => "Детали Заказа",
            'payment_method' => "💳 Выберите способ оплаты:",
            'humo' => "🏦 Humo (9860 1666 5364 4418)",
            'visa' => "💳 Visa (4738 7203 4457 8541)",
            'click' => "📱 Click (5614681626866978)",
            'product' => "Продукт",
            'price' => "Цена",
            'menu_unpaid_orders' => 'Неоплаченные заказы',
            'no_unpaid_orders' => 'У вас нет неоплаченных заказов.',
            'products' => 'Продуктu'

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
            'order_details' => "Buyurtma Tafsilotlari",
            'payment_method' => "💳 To'lov usulini tanlang:",
            'humo' => "🏦 Humo (9860 1666 5364 4418)",
            'visa' => "💳 Visa (4738 7203 4457 8541)",
            'click' => "📱 Click (5614681626866978)",
            'product' => 'Mahsulot',
            'price' => 'Narxi',
            'menu_unpaid_orders' => 'To‘lanmagan buyurtmalar',
            'no_unpaid_orders' => 'Sizda to‘lanmagan buyurtmalar yo‘q.',
            'products' => 'Mahsulotlar'

        ]
    ];

    private function normalizePhone($phone)
    {
        $cleaned = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($cleaned) === 9) {
            $cleaned = '998' . $cleaned;
        }

        return $cleaned;
    }

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
                    ['text' => $this->trans('menu_unpaid_orders', $lang)],
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
        $order = Order::where('chat_id', $chatId)->first();
        return $order && $order->language ? $order->language : 'en';
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

        if (isset($data['message'])) {
            $chatId = $data['message']['chat']['id'];
            $text = $data['message']['text'] ?? '';
            $lang = $this->getUserLanguage($chatId);

            if ($text === '/start') {
                $existingOrder = Order::where('chat_id', $chatId)->first();

                if ($existingOrder && $existingOrder->language) {
                    $lang = $existingOrder->language;

                    $keyboard = [
                        'keyboard' => [
                            [
                                [
                                    'text' => $this->trans('phone_button', $lang),
                                    'request_contact' => true
                                ]
                            ]
                        ],
                        'one_time_keyboard' => true,
                        'resize_keyboard' => true
                    ];

                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => $this->trans('share_phone', $lang),
                        'reply_markup' => json_encode($keyboard)
                    ]);
                } else {
                    // New user, ask for language
                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => $this->trans('welcome', 'en'),
                        'reply_markup' => json_encode($this->getLanguageKeyboard())
                    ]);
                }
                return response()->json(['ok' => true]);
            }

            if (
                strpos($text, $this->trans('menu_orders', $lang)) !== false ||
                strpos($text, '📦') === 0
            ) {
                $this->showOrderHistory($chatId, $lang, $token);
                return response()->json(['ok' => true]);
            }

            if (
                strpos($text, $this->trans('menu_language', $lang)) !== false ||
                strpos($text, '🌍') === 0
            ) {
                Http::post($apiUrl, [
                    'chat_id' => $chatId,
                    'text' => $this->trans('welcome', $lang),
                    'reply_markup' => json_encode($this->getLanguageKeyboard())
                ]);
                return response()->json(['ok' => true]);
            }

            if (
                strpos($text, $this->trans('menu_unpaid_orders', $lang)) !== false
            ) {
                $orders = Order::where('chat_id', $chatId)
                    ->where('status', 'created')
                    ->whereNotNull('address')
                    ->with('items.product')
                    ->latest()
                    ->get();

                if ($orders->isNotEmpty()) {
                    foreach ($orders as $order) {
                        $productsList = "";
                        foreach ($order->items as $item) {
                            $productsList .= "   • {$item->product->name_uz} x{$item->quantity} - {$item->price} so'm\n";
                        }

                        $message = "{$this->trans('orders_found',$lang)}\n\n" .
                            "{$this->trans('order_id',$lang)}: #{$order->id}\n" .
                            "👤 {$order->first_name} {$order->last_name}\n" .
                            "📍 {$order->address}\n" .
                            "📞 {$order->phone}\n\n" .
                            "🛒 {$this->trans('products',$lang)}:\n{$productsList}\n" .
                            "💰 {$this->trans('total',$lang)}: {$order->total} so'm\n" .
                            "📊 {$this->trans('status',$lang)}: {$this->trans($order->status,$lang)}\n\n" .
                            $this->trans('send_payment', $lang);

                        $keyboard = [
                            'inline_keyboard' => [[
                                ['text' => '💳 To\'lov qilish', 'callback_data' => "show_payment_{$order->id}"]
                            ]]
                        ];

                        Http::post($apiUrl, [
                            'chat_id' => $chatId,
                            'text' => $message,
                            'reply_markup' => json_encode($keyboard)
                        ]);
                    }

                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => '✅',
                        'reply_markup' => json_encode($this->getMainMenuKeyboard($lang))
                    ]);
                } else {
                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => $this->trans('no_unpaid_orders', $lang),
                        'reply_markup' => json_encode($this->getMainMenuKeyboard($lang))
                    ]);
                }

                return response()->json(['ok' => true]);
            }

            // Phone number handling
            if (isset($data['message']['contact'])) {
                $phone = $data['message']['contact']['phone_number'];
                $normalizedPhone = $this->normalizePhone($phone);

                // Update chat ID
                Order::updateOrCreate(
                    ['chat_id' => $chatId],
                    ['phone' => $normalizedPhone]
                );

                // Update all matching orders
                Order::where('phone', 'LIKE', '%' . substr($normalizedPhone, -9))
                    ->update(['chat_id' => $chatId]);

                // Find orders with LIKE operator
                $orders = Order::where(function ($query) use ($normalizedPhone) {
                    $query->where('phone', $normalizedPhone)
                        ->orWhere('phone', 'LIKE', '%' . substr($normalizedPhone, -9))
                        ->orWhere('phone', '+' . $normalizedPhone);
                })
                    ->where('status', 'created')
                    ->whereNotNull('address')
                    ->with('items.product')
                    ->latest()
                    ->get();

                if ($orders->isNotEmpty()) {
                    foreach ($orders as $order) {
                        $productsList = "";
                        foreach ($order->items as $item) {
                            $productsList .= "   • {$item->product->name_uz} x{$item->quantity} - {$item->price} so'm\n";
                        }

                        $message = "{$this->trans('orders_found',$lang)}\n\n" .
                            "{$this->trans('order_id',$lang)}: #{$order->id}\n" .
                            "👤 {$order->first_name} {$order->last_name}\n" .
                            "📍 {$order->address}\n" .
                            "📞 {$order->phone}\n\n" .
                            "🛒 {$this->trans('products',$lang)}:\n{$productsList}\n" .
                            "💰 {$this->trans('total',$lang)}: {$order->total} so'm\n" .
                            "📊 {$this->trans('status',$lang)}: {$this->trans($order->status,$lang)}\n\n" .
                            $this->trans('send_payment', $lang);

                        $keyboard = [
                            'inline_keyboard' => [[
                                ['text' => '💳 To\'lov qilish', 'callback_data' => "show_payment_{$order->id}"]
                            ]]
                        ];

                        Http::post($apiUrl, [
                            'chat_id' => $chatId,
                            'text' => $message,
                            'reply_markup' => json_encode($keyboard)
                        ]);
                    }

                    // Remove phone button and show main menu
                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => '✅',
                        'reply_markup' => json_encode($this->getMainMenuKeyboard($lang))
                    ]);
                } else {
                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => $this->trans('no_orders', $lang),
                        'reply_markup' => json_encode($this->getMainMenuKeyboard($lang))
                    ]);
                }
            }

            // Photo handling (payment screenshot)
            if (isset($data['message']['photo'])) {
                $photo = end($data['message']['photo']);
                $fileId = $photo['file_id'];

                $order = Order::where('chat_id', $chatId)
                    ->where('status', 'created')
                    ->with('items.product')
                    ->latest()
                    ->first();

                if ($order) {
                    $channelId = env('TELEGRAM_CHAT_ID');
                    $productsList = "";
                    foreach ($order->items as $item) {
                        $productsList .= "   • {$item->product->name_uz} x{$item->quantity} - {$item->price} so'm\n";
                    }

                    $response = Http::post("https://api.telegram.org/bot{$token}/sendPhoto", [
                        'chat_id' => $channelId,
                        'photo' => $fileId,
                        'caption' => "💳 Payment Screenshot\n\n" .
                            "Order ID: #{$order->id}\n" .
                            "👤 {$order->first_name} {$order->last_name}\n" .
                            "📞 {$order->phone}\n" .
                            "📍 {$order->address}\n\n" .
                            "🛒 Maxsulotlar:\n{$productsList}\n" .
                            "💰 Total: {$order->total} so'm\n" .
                            "📊 Status: {$order->status}\n",
                        'reply_markup' => json_encode([
                            'inline_keyboard' => [[
                                ['text' => '✅ Tasdiqlash', 'callback_data' => "approve_{$order->id}"],
                                ['text' => '❌ Bekor qilish', 'callback_data' => "reject_{$order->id}"]
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

        // Callback query handling
        if (isset($data['callback_query'])) {
            $callbackId = $data['callback_query']['id'];
            $callbackData = $data['callback_query']['data'];
            $chatId = $data['callback_query']['message']['chat']['id'];
            $messageId = $data['callback_query']['message']['message_id'];

            if (strpos($callbackData, 'show_payment_') === 0) {
                $orderId = substr($callbackData, 13);
                $order = Order::find($orderId);

                if ($order && $order->status === 'created') {
                    $lang = $this->getUserLanguage($chatId);

                    Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
                        'callback_query_id' => $callbackId,
                        'text' => $this->trans('payment_method', $lang)
                    ]);

                    Http::post($apiUrl, [
                        'chat_id' => $chatId,
                        'text' => $this->trans('payment_method', $lang),
                        'reply_markup' => json_encode($this->getPaymentMethodsKeyboard())
                    ]);
                }

                return response()->json(['ok' => true]);
            }

            if (strpos($callbackData, 'payment_') === 0) {
                $paymentMethod = substr($callbackData, 8);
                $lang = $this->getUserLanguage($chatId);

                $paymentDetails = [
                    'humo' => [
                        'name' => 'Humo Virtual',
                        'card' => '9860 1666 5364 4418',
                        'owner' => 'Jurayev Y'
                    ],
                    'visa' => [
                        'name' => 'Visa',
                        'card' => '4738 7203 4457 8541',
                        'owner' => 'Yunus Jurayev'
                    ],
                    'click' => [
                        'name' => 'Click',
                        'card' => '5614681626866978',
                        'owner' => 'Jurayev Ismoil'
                    ]
                ];

                $details = $paymentDetails[$paymentMethod];

                $message = "💳 To'lov tafsilotlari:\n\n" .
                    "Usuli: {$details['name']}\n" .
                    "Karta: {$details['card']}\n" .
                    "Egasi: {$details['owner']}\n\n" .
                    "📸 To'lovdan keyin skrinshot yuboring\n" .
                    "⏱ Admin 15-30 daqiqada tasdiqlaydi";

                Http::post($apiUrl, [
                    'chat_id' => $chatId,
                    'text' => $message,
                    'reply_markup' => json_encode($this->getMainMenuKeyboard($lang))
                ]);

                Order::where('chat_id', $chatId)
                    ->where('status', 'created')
                    ->latest()
                    ->first()
                    ?->update(['payment_method' => $paymentMethod]);

                Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
                    'callback_query_id' => $callbackId,
                    'text' => '✅ To\'lov usuli tanlab olindi'
                ]);

                return response()->json(['ok' => true]);
            }

            if (strpos($callbackData, 'lang_') === 0) {
                $selectedLang = substr($callbackData, 5);
                $this->setUserLanguage($chatId, $selectedLang);

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

            if (strpos($callbackData, 'approve_') === 0 || strpos($callbackData, 'reject_') === 0) {
                list($action, $orderId) = explode('_', $callbackData);
                $order = Order::with('items.product')->find($orderId);

                if ($order) {
                    $userChatId = $order->chat_id;
                    $lang = $this->getUserLanguage($userChatId);

                    $productsList = "";
                    foreach ($order->items as $item) {
                        $productsList .= "   • {$item->product->name_uz} x{$item->quantity} - {$item->price} so'm\n";
                    }

                    if ($action === 'approve') {
                        $order->update(['status' => 'approved']);

                        Http::post($apiUrl, [
                            'chat_id' => $userChatId,
                            'text' => "{$this->trans('payment_approved',$lang)}\n\n" .
                                "{$this->trans('order_id',$lang)}: #{$order->id}\n" .
                                "🛒 {$this->trans('products',$lang)}:\n{$productsList}\n" .
                                "💰 {$this->trans('total',$lang)}: {$order->total} so'm\n" .
                                "{$this->trans('status',$lang)}: {$this->trans('approved',$lang)}\n\n" .
                                $this->trans('order_confirmed', $lang)
                        ]);

                        Http::post("https://api.telegram.org/bot{$token}/editMessageCaption", [
                            'chat_id' => $chatId,
                            'message_id' => $messageId,
                            'caption' => "✅ APPROVED\n\n" .
                                "Order ID: #{$order->id}\n" .
                                "👤 {$order->first_name} {$order->last_name}\n" .
                                "📞 {$order->phone}\n" .
                                "📍 {$order->address}\n\n" .
                                "🛒 Maxsulotlar:\n{$productsList}\n" .
                                "💰 Total: {$order->total} so'm\n" .
                                "📊 Status: approved"
                        ]);
                    } elseif ($action === 'reject') {
                        $order->update(['status' => 'rejected']);

                        Http::post($apiUrl, [
                            'chat_id' => $userChatId,
                            'text' => "{$this->trans('payment_rejected',$lang)}\n\n" .
                                "{$this->trans('order_id',$lang)}: #{$order->id}\n" .
                                "🛒 {$this->trans('products',$lang)}:\n{$productsList}\n" .
                                "💰 {$this->trans('total',$lang)}: {$order->total} so'm\n" .
                                "{$this->trans('status',$lang)}: {$this->trans('rejected',$lang)}\n\n" .
                                $this->trans('contact_support', $lang)
                        ]);

                        Http::post("https://api.telegram.org/bot{$token}/editMessageCaption", [
                            'chat_id' => $chatId,
                            'message_id' => $messageId,
                            'caption' => "❌ REJECTED\n\n" .
                                "Order ID: #{$order->id}\n" .
                                "👤 {$order->first_name} {$order->last_name}\n" .
                                "📞 {$order->phone}\n" .
                                "📍 {$order->address}\n\n" .
                                "🛒 Maxsulotlar:\n{$productsList}\n" .
                                "💰 Total: {$order->total} so'm\n" .
                                "📊 Status: rejected"
                        ]);
                    }

                    Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
                        'callback_query_id' => $callbackId,
                        'text' => $action === 'approve' ? '✅ Order Approved' : '❌ Order Rejected'
                    ]);
                }

                return response()->json(['ok' => true]);
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
            $message = "{$this->trans('order_history',$lang)}\n\n";

            foreach ($orders as $order) {
                $message .= "━━━━━━━━━━━━━━━\n";
                $message .= "{$this->trans('order_id',$lang)}: #{$order->id}\n";
                $message .= "👤 {$order->first_name} {$order->last_name}\n";
                $message .= "📍 {$order->address}\n";
                $message .= "💰 {$this->trans('total',$lang)}: {$order->total}\n";
                $message .= "📊 {$this->trans('status',$lang)}: {$this->trans($order->status,$lang)}\n";
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

    private function getPaymentMethodsKeyboard()
    {
        return [
            'inline_keyboard' => [
                [
                    ['text' => '🏦 Humo Virtual', 'callback_data' => 'payment_humo'],
                    ['text' => '💳 Visa', 'callback_data' => 'payment_visa']
                ],
                [
                    ['text' => '📱 Click', 'callback_data' => 'payment_click']
                ],
                [
                    ['text' => '🔙 Orqaga', 'callback_data' => 'back_to_menu']
                ]
            ]
        ];
    }
}
