<!-- Font Awesome (keep in head) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .site-logo {
        width: 200px;
        height: 95px;
        margin-left: 10px;
    }

    .site-logo a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .site-logo-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Fix cart badge */
    .icons .bag {
        position: relative;
        display: inline-block;
        font-size: 20px;
        /* adjust cart icon size */
    }

    .icons .bag .number {
        position: absolute;
        top: -8px;
        right: -10px;
        background: red;
        color: white;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 50%;
    }
</style>

<div class="site-navbar py-2">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="logo">
                <div class="site-logo">
                    <a href="{{ url('/') }}" class="js-logo-clone">
                        <img src="{{ asset('images/sinotip.jpg') }}" class="site-logo-img">
                    </a>
                </div>
            </div>

            <div class="main-nav d-none d-lg-block">
                <nav class="site-navigation text-right text-md-center" role="navigation">
                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <a href="{{ route('home', app()->getLocale()) }}">{{ __('messages.home') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('store') ? 'active' : '' }}">
                            <a href="{{ route('store', app()->getLocale()) }}">{{ __('messages.store') }}</a>
                        </li>
                        <li class="has-children">
                            <a href="#">{{ __('messages.language') }}</a>
                            <ul class="dropdown">
                                <li><a
                                        href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), array_merge(request()->route()->parameters(), ['locale' => 'uz'])) }}">🇺🇿
                                        Uzbek</a></li>
                                <li><a
                                        href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), array_merge(request()->route()->parameters(), ['locale' => 'ru'])) }}">🇷🇺
                                        Russian</a></li>
                                <li><a
                                        href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), array_merge(request()->route()->parameters(), ['locale' => 'en'])) }}">🇬🇧
                                        English</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="icons">
                <a href="{{ route('cart.index', app()->getLocale()) }}" class="icons-btn d-inline-block bag">
                    <i class="fas fa-shopping-cart"></i>
                    @php
                        $cart = \App\Models\Cart::where('session_id', session()->getId())->first();
                        $cartCount = $cart ? $cart->items()->sum('quantity') : 0;
                    @endphp

                    <span class="number">{{ $cartCount }}</span>

                </a>

                <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none">
                    <span class="icon-menu"></span>
                </a>
            </div>
        </div>
    </div>
</div>
