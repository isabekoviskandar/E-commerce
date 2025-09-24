<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pharmative &mdash; Colorlib Template</title>
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

        {{-- Navbar --}}
        <div class="site-navbar py-2">
            <div class="search-wrap">
                <div class="container">
                    <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                    <form action="#" method="post">
                        <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
                    </form>
                </div>
            </div>


            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <div class="site-logo">
                            <a href="{{ url('/') }}" class="js-logo-clone"><strong
                                    class="text-primary">Pharma</strong>tive</a>
                        </div>
                    </div>
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li class="active">
                                    <a href="{{ route('home', app()->getLocale()) }}">{{ __('messages.home') }}</a>
                                </li>

                                <li><a href="{{ route('store', app()->getLocale()) }}">{{ __('messages.store') }}</a>
                                </li>
                                <li><a href="{{ route('about', app()->getLocale()) }}">{{ __('messages.about') }}</a></li>
                                {{-- <li><a href="{{ route('contact', app()->getLocale()) }}">Contact</a></li> --}}

                                {{-- Language Switcher --}}
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

        {{-- Hero Section --}}
        <div class="owl-carousel owl-single px-0">
            <div class="site-blocks-cover overlay" style="background-image: url('{{ asset('images/hero_bg.jpg') }}');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mx-auto align-self-center">
                            <div class="site-block-cover-content text-center">
                                <h1 class="mb-0"><strong class="text-primary">Pharmative</strong>
                                    {{ __('messages.open_message') }}</h1>
                                <div class="row justify-content-center mb-5">
                                    <div class="col-lg-6 text-center">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </div>
                                </div>
                                <p><a href="{{ url('/store') }}"
                                        class="btn btn-primary px-5 py-3">{{ __('messages.shop_now') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="site-blocks-cover overlay"
                style="background-image: url('{{ asset('images/hero_bg_2.jpg') }}');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mx-auto align-self-center">
                            <div class="site-block-cover-content text-center">
                                <h1 class="mb-0">New Medicine <strong class="text-primary">Everyday</strong></h1>
                                <div class="row justify-content-center mb-5">
                                    <div class="col-lg-6 text-center">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </div>
                                </div>
                                <p><a href="{{ url('/store') }}" class="btn btn-primary px-5 py-3">Shop Now</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Products --}}
        <div class="site-section bg-light">
            <div class="container">
                <div class="row">
                    <div class="title-section text-center col-12">
                        <h2>Pharmacy <strong class="text-primary">Products</strong></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 block-3 products-wrap">
                        <div class="nonloop-block-3 owl-carousel">
                            @forelse ($products as $product)
                                <div class="text-center item mb-4 item-v2">
                                    <a
                                        href="{{ route('product.single', ['id' => $product->id, 'locale' => app()->getLocale()]) }}">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name_uz }}">
                                    </a>
                                    <h3 class="text-dark">
                                        <a
                                            href="{{ route('product.single', ['id' => $product->id, 'locale' => app()->getLocale()]) }}">
                                            {{ $product->name_uz }}
                                        </a>
                                    </h3>
                                    <p class="price">{{ number_format($product->price) }} uzs</p>
                                </div>
                            @empty
                                <p class="text-center w-100">No products available</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
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
                                <li class="phone"><a href="#">+998 94 783 69 96</a></li>
                                <li class="email">jurayevyunus783@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <p>
                            &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            {{ __('messages.copyright') }}
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    {{-- Scripts --}}
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
