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
        @include('helpers.navbar')

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



        @include('helpers.footer')
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
