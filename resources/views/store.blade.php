<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{ __('messages.store') }} &mdash; Pharmative</title>
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
                            <a href="/" class="js-logo-clone"><strong class="text-primary">Pharma</strong>tive</a>
                        </div>
                    </div>
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li>
                                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">
                                        {{ __('messages.home') }}
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{ route('store', ['locale' => app()->getLocale()]) }}">
                                        {{ __('messages.store') }}
                                    </a>
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

                                {{-- <li><a href="/about">{{ __('messages.about') }}</a></li> --}}
                                {{-- <li><a href="/contact">{{ __('messages.contact') }}</a></li> --}}
                            </ul>
                        </nav>
                    </div>
                    <div class="icons">
                        <a href="#" class="icons-btn d-inline-block js-search-open"><span
                                class="icon-search"></span></a>
                        <a href="{{ route('cart.index') }}" class="icons-btn d-inline-block bag">
                            <span class="icon-shopping-bag"></span>
                            <span class="number">{{ count(session('cart', [])) }}</span>
                        </a>
                        <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                                class="icon-menu"></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <a href="/">{{ __('messages.home') }}</a> <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">{{ __('messages.store') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="container">
                <form method="GET" action="{{ route('store', app()->getLocale()) }}" class="mb-4">

                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">{{ __('messages.filter_category') }}
                            </h3>
                            <select name="category_id" class="form-control" onchange="this.form.submit()">
                                <option value="">{{ __('messages.all_categories') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_uz }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 text-lg-right">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">{{ __('messages.sort_by') }}</h3>
                            <select name="sort" class="form-control" onchange="this.form.submit()">
                                <option value="">{{ __('messages.default') }}</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                    {{ __('messages.name_asc') }}</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                    {{ __('messages.name_desc') }}</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                    {{ __('messages.price_asc') }}</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                    {{ __('messages.price_desc') }}</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="site-section bg-light">
            <div class="container">
                <div class="row">
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-lg-4 text-center item mb-4 item-v2">
                                <a
                                    href="{{ route('product.single', ['locale' => app()->getLocale(), 'id' => $product->id]) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name_uz }}">
                                </a>

                                <h3 class="text-dark">
                                    <a
                                        href="{{ route('product.single', ['locale' => app()->getLocale(), 'id' => $product->id]) }}">
                                        {{ $product->name_uz }}
                                    </a>
                                </h3>

                                <p class="price">{{ number_format($product->price) }} uzs</p>
                                @if ($product->category)
                                    <small class="text-muted">{{ $product->category->name_uz }}</small>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <div class="alert alert-info">
                                <h4>{{ __('messages.no_products') }}</h4>
                                <p>{{ __('messages.no_products_text') }}</p>
                                <a href="{{ route('store', app()->getLocale()) }}" class="btn btn-primary">
                                    {{ __('messages.view_all') }}
                                </a>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

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
