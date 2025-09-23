<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>Pharmative</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="site-wrap">
        <!-- Navbar -->
        <div class="site-navbar py-2">
            <div class="search-wrap">
                <div class="container">
                    <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                    <form action="#" method="post">
                        <input type="text" class="form-control"
                            placeholder="{{ __('messages.search_placeholder') }}">
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <div class="site-logo">
                            <a href="{{ route('home', app()->getLocale()) }}" class="js-logo-clone">
                                <strong class="text-primary">Pharma</strong>tive
                            </a>
                        </div>
                    </div>
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li><a href="{{ route('home', app()->getLocale()) }}">{{ __('messages.home') }}</a>
                                </li>
                                <li><a href="{{ route('store', app()->getLocale()) }}">{{ __('messages.store') }}</a>
                                </li>
                                <li><a href="#">{{ __('messages.about') }}</a></li>
                                <li><a href="#">{{ __('messages.contact') }}</a></li>

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
                        <a href="#" class="icons-btn d-inline-block js-search-open"><span
                                class="icon-search"></span></a>
                        <a href="{{ route('cart.index', app()->getLocale()) }}" class="icons-btn d-inline-block bag">
                            <span class="icon-shopping-bag"></span>
                            <span class="number">{{ count(session('cart', [])) }}</span>
                        </a>

                        <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                                class="icon-menu"></span></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <a href="{{ route('home', app()->getLocale()) }}">{{ __('messages.home') }}</a>
                        <span class="mx-2 mb-0">/</span>
                        <a href="{{ route('store', app()->getLocale()) }}">{{ __('messages.store') }}</a>
                        <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">{{ __('messages.cart') }}</strong>
                    </div>

                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="site-section">
            <div class="container">
                <h2>{{ __('messages.cart') }}</h2>
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>{{ __('messages.image') }}</th>
                            <th>{{ __('messages.product_name') }}</th>
                            <th>{{ __('messages.price') }}</th>
                            <th>{{ __('messages.quantity') }}</th>
                            <th>{{ __('messages.total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cart as $id => $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item['image']) }}" width="80">
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ number_format($item['price']) }} uzs</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ number_format($item['price'] * $item['quantity']) }} uzs</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">{{ __('messages.cart_empty') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Footer -->
        <footer class="site-footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="block-7">
                            <h3 class="footer-heading mb-4">{{ __('messages.about_title') }}</h3>
                            <p>{{ __('messages.about_text') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
                        <h3 class="footer-heading mb-4">{{ __('messages.navigation') }}</h3>
                        <ul class="list-unstyled">
                            <li><a href="#">{{ __('messages.supplements') }}</a></li>
                            <li><a href="#">{{ __('messages.vitamins') }}</a></li>
                            <li><a href="#">{{ __('messages.diet') }}</a></li>
                            <li><a href="#">{{ __('messages.tea') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="block-5 mb-5">
                            <h3 class="footer-heading mb-4">{{ __('messages.contact_info') }}</h3>
                            <ul class="list-unstyled">
                                <li class="address">{{ __('messages.address') }}</li>
                                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                                <li class="email">emailaddress@domain.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
