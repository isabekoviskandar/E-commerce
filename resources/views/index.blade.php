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
        {{-- Navbar --}}
        @include('helpers.navbar')

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
        @include('helpers.footer')
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
