<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $product->name_uz }} &mdash; Pharmative</title>
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

<style>
    /* Gradient Blur Button */
    .btn-gradient {
        background: linear-gradient(45deg, #181a9e, #172496);
        border: none;
        color: #fff;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 10px 20px;
    }

    .btn-gradient:hover {
        background: linear-gradient(45deg, #1b1da8, #1ea085);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(24, 26, 158, 0.3);
    }

    .btn-gradient:active {
        transform: translateY(0);
    }

    /* Gradient Outline for +/- */
    .btn-gradient-outline {
        background: transparent;
        border: 2px solid #181a9e;
        color: #181a9e;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-gradient-outline:hover {
        background: linear-gradient(45deg, #181a9e, #172496);
        color: #fff;
        transform: translateY(-2px);
    }

    /* Price display styling */
    .total-price {
        transition: all 0.3s ease;
    }
</style>

<body>
    @include('helpers.navbar')

    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="/">Home</a> <span class="mx-2 mb-0">/</span>
                    <a href="/store">Store</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{ $product->name_uz }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mr-auto">
                    <div class="border text-center">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_uz }}"
                            class="img-fluid p-5">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $product->name_uz }}</h2>

                    @if ($product->description_uz)
                        <p>{{ $product->description_uz }}</p>
                    @else
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, vitae, explicabo?
                            Incidunt facere, natus soluta dolores iusto! Molestiae expedita veritatis nesciunt
                            doloremque sint asperiores fuga
                            voluptas, distinctio, aperiam, ratione dolore.</p>
                    @endif

                    <div class="price-section mb-3">
                        <p class="mb-1"><small class="text-muted">Unit Price: <span
                                    class="unit-price">{{ $product->price }}</span> uzs</small></p>
                        <p><strong class="text-primary h4 total-price">{{ $product->price }} uzs</strong></p>
                    </div>

                    <form action="{{ route('cart.add', ['locale' => app()->getLocale(), 'id' => $product->id]) }}"
                        method="POST">
                        @csrf
                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 220px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-gradient-outline js-btn-minus"
                                        type="button">&minus;</button>
                                </div>
                                <input type="number" name="quantity" id="quantity-input"
                                    class="form-control text-center" value="1" min="1">
                                <div class="input-group-append">
                                    <button class="btn btn-gradient-outline js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>
                        </div>

                        <p>
                            <button type="submit" class="buy-now btn btn-sm height-auto px-4 py-3 btn-gradient">
                                Add To Cart
                            </button>
                        </p>
                    </form>

                    <div class="mt-5">
                        <ul class="nav nav-pills mb-3 custom-pill" id="pills-tab" role="tablist">
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <table class="table custom-table">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Product Name</td>
                                            <td>{{ $product->name_uz }}</td>
                                        </tr>
                                        <tr>
                                            <td>Unit Price</td>
                                            <td class="unit-price-table">{{ $product->price }} uzs</td>
                                        </tr>
                                        <tr>
                                            <td>Total Price</td>
                                            <td class="total-price-table">{{ $product->price }} uzs</td>
                                        </tr>
                                        @if ($product->category)
                                            <tr>
                                                <td>Category</td>
                                                <td>{{ $product->category->name_uz }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <table class="table custom-table">
                                    <tbody>
                                        <tr>
                                            <td>Product ID</td>
                                            <td class="bg-light">{{ $product->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Available</td>
                                            <td class="bg-light">Yes</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                        @foreach ($footer_categories as $category)
                            <li>
                                <a
                                    href="{{ route('store', app()->getLocale(), ['category_id' => $category->id]) }}">
                                    {{ $category->name_uz }}
                                </a>
                            </li>
                        @endforeach
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

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Get the unit price from PHP (remove any non-numeric characters and parse as float)
            const unitPrice = parseFloat('{{ $product->price }}'.replace(/[^\d.-]/g, ''));

            // Function to update the total price display
            function updateTotalPrice() {
                const quantity = parseInt($('#quantity-input').val()) || 1;
                const totalPrice = unitPrice * quantity;

                // Format the price with thousand separators if needed
                const formattedPrice = totalPrice.toLocaleString();

                // Update all price displays without animation
                $('.total-price').text(formattedPrice + ' uzs');
                $('.total-price-table').text(formattedPrice + ' uzs');
            }

            // Remove any existing event handlers to prevent conflicts
            $('.js-btn-plus').off('click');
            $('.js-btn-minus').off('click');

            // Plus button click handler
            $('.js-btn-plus').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const quantityInput = $('#quantity-input');
                let currentQuantity = parseInt(quantityInput.val()) || 1;
                quantityInput.val(currentQuantity + 1);
                updateTotalPrice();
            });

            // Minus button click handler
            $('.js-btn-minus').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const quantityInput = $('#quantity-input');
                let currentQuantity = parseInt(quantityInput.val()) || 1;
                if (currentQuantity > 1) {
                    quantityInput.val(currentQuantity - 1);
                    updateTotalPrice();
                }
            });

            // Handle manual input changes
            $('#quantity-input').on('input', function() {
                let quantity = parseInt($(this).val());

                // Ensure minimum quantity is 1
                if (quantity < 1 || isNaN(quantity)) {
                    quantity = 1;
                    $(this).val(1);
                }

                updateTotalPrice();
            });

            // Initialize with correct price on page load
            updateTotalPrice();
        });
    </script>
</body>

</html>
