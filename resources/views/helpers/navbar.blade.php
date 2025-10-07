<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .site-logo {
        width: 150px;
        height: 70px;
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

    .site-navbar {
        padding: 10px 0;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .d-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .main-nav {
        display: none;
    }

    .main-nav.active {
        display: block;
    }

    .site-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .site-menu li {
        display: inline-block;
        margin: 0 15px;
    }

    .site-menu li a {
        text-decoration: none;
        color: #333;
        font-size: 16px;
    }

    .site-menu li.active a {
        color: #007bff;
        font-weight: bold;
    }

    .has-children {
        position: relative;
    }

    .dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        list-style: none;
        padding: 10px;
        margin: 0;
        min-width: 150px;
    }

    .has-children:hover .dropdown {
        display: block;
    }

    .dropdown li {
        display: block;
        margin: 5px 0;
    }

    .dropdown li a {
        font-size: 14px;
    }

    .icons {
        display: flex;
        align-items: center;
    }

    .icons .bag {
        position: relative;
        display: inline-block;
        font-size: 20px;
        margin-right: 15px;
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

    .site-menu-toggle {
        display: none;
        font-size: 24px;
        color: #333;
        cursor: pointer;
    }

    .icon-menu::before {
        content: "\f0c9";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
    }

    @media (min-width: 992px) {
        .main-nav {
            display: block;
        }
        .site-menu-toggle {
            display: none !important;
        }
    }

    @media (max-width: 991px) {
        .site-logo {
            width: 120px;
            height: 60px;
        }

        .main-nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .main-nav.active {
            display: block;
        }

        .site-menu {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .site-menu li {
            display: block;
            margin: 10px 0;
        }

        .dropdown {
            position: static;
            box-shadow: none;
            display: none;
            padding: 10px 20px;
        }

        .has-children.active .dropdown {
            display: block;
        }

        .site-menu-toggle {
            display: inline-block;
        }
    }

    @media (max-width: 576px) {
        .site-logo {
            width: 100px;
            height: 50px;
        }

        .icons .bag {
            font-size: 18px;
        }

        .icons .bag .number {
            font-size: 10px;
            padding: 1px 5px;
        }
    }
</style>

<div class="site-navbar py-2">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="logo">
                <div class="site-logo">
                    <a href="{{ url('/') }}" class="js-logo-clone">
                        <img src="{{ asset('images/sinotip.jpg') }}" class="site-logo-img" alt="Site Logo">
                    </a>
                </div>
            </div>

            <div class="main-nav" id="main-nav">
                <nav class="site-navigation text-right text-md-center" role="navigation">
                    <ul class="site-menu js-clone-nav">
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <a href="{{ route('home', app()->getLocale()) }}">{{ __('messages.home') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('store') ? 'active' : '' }}">
                            <a href="{{ route('store', app()->getLocale()) }}">{{ __('messages.store') }}</a>
                        </li>
                        <li class="has-children">
                            <a href="#" class="language-toggle">{{ __('messages.language') }}</a>
                            <ul class="dropdown">
                                <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), array_merge(request()->route()->parameters(), ['locale' => 'uz'])) }}">🇺🇿 Uzbek</a></li>
                                <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), array_merge(request()->route()->parameters(), ['locale' => 'ru'])) }}">🇷🇺 Russian</a></li>
                                <li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), array_merge(request()->route()->parameters(), ['locale' => 'en'])) }}">🇬🇧 English</a></li>
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
                <a href="#" class="site-menu-toggle js-menu-toggle ml-3">
                    <span class="icon-menu"></span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.querySelector('.site-menu-toggle');
        const mainNav = document.querySelector('#main-nav');
        const languageToggle = document.querySelector('.language-toggle');
        const dropdown = document.querySelector('.dropdown');

        menuToggle.addEventListener('click', function (e) {
            e.preventDefault();
            mainNav.classList.toggle('active');
        });

        languageToggle.addEventListener('click', function (e) {
            e.preventDefault();
            const parentLi = languageToggle.parentElement;
            parentLi.classList.toggle('active');
        });
    });
</script>