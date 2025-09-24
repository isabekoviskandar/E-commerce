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
                            <a href="{{ url('/') }}" class="js-logo-clone">Dr Abdushukur</a>
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

                                <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                                    <a href="{{ route('about', app()->getLocale()) }}">{{ __('messages.about') }}</a>
                                </li>

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
