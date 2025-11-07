<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sinotib</title>
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


        @include('helpers.navbar')


        <div class="site-section">
            <div class="container">
                <form action="{{ route('checkout.place', app()->getLocale()) }}" method="POST" onsubmit="openBot()">
                    @csrf
                    <div class="row">
                        {{-- Billing Details --}}
                        <div class="col-md-6 mb-5 mb-md-0">
                            <div class="p-3 p-lg-5 border">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="c_fname" class="text-black">{{ __('messages.first_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_fname" name="first_name"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_lname" class="text-black">{{ __('messages.last_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_lname" name="last_name"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_address" class="text-black">{{ __('messages.user_address') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_address" name="address"
                                            placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-5">
                                    <div class="col-md-6">
                                        <label for="c_phone" class="text-black">{{ __('messages.user_phone') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_phone" name="phone"
                                            placeholder="+998950200926" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Order Summary --}}
                        <div class="col-md-6">
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="p-3 p-lg-5 border">
                                        <table class="table site-block-order-table mb-5">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.products') }}</th>
                                                    <th>{{ __('messages.price') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $subtotal = 0; @endphp
                                                @foreach ($cartItems as $item)
                                                    @php
                                                        $lineTotal = $item->product->price * $item->quantity;
                                                        $subtotal += $lineTotal;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            {{ $item->product->{'name_' . app()->getLocale()} }}

                                                            <strong class="mx-2">x</strong> {{ $item->quantity }}
                                                        </td>
                                                        <td>{{ number_format($lineTotal) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="text-black font-weight-bold">
                                                        <strong>{{ __('messages.total') }}</strong>
                                                    </td>
                                                    <td class="text-black font-weight-bold">
                                                        <strong>{{ number_format($subtotal) }}</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        {{-- Submit button --}}
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                {{ __('messages.place_order') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> {{-- row --}}
                </form>
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
                            @foreach ($footer_categories as $category)
                                <li>
                                    <a
                                        href="{{ route('store', app()->getLocale(), ['category_id' => $category->id]) }}">{{ $category->name_uz }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="block-5 mb-5">
                            <h3 class="footer-heading mb-4">{{ __('messages.contact_info') }}</h3>
                            <ul class="list-unstyled">
                                <li class="location">
                                    <a href="https://www.google.com/maps/search/?api=1&query=Your+Address"
                                        target="_blank">
                                        {{ __('messages.address') }}
                                    </a>
                                </li>

                                <li class="phone">
                                    <a href="tel:+998947836996">+998 94 783 69 96</a>
                                </li>
                                <li class="phone">
                                    <a href="tel:+998984446969">+998 98 444 69 69</a>
                                </li>
                                <li class="email">
                                    <a href="mailto:abdushukurtabiboriginal@gmail.com">
                                        abdushukurtabiboriginal@gmail.com</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script>
        function openBot() {
            setTimeout(function() {
                window.open("https://t.me/abdushukur_tabib_bot", "_blank");
            }, 1000); // wait 1 second to ensure submit request is sent
        }
    </script>
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
