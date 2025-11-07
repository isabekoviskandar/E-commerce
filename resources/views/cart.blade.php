<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

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

<style>
    .btn-danger-outline {
        background: transparent;
        border: 2px solid #dc3545;
        color: #dc3545;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 5px 15px;
    }

    .btn-danger-outline:hover {
        background: #dc3545;
        color: #fff;
        transform: translateY(-2px);
    }

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

    .btn-gradient-outline {
        background: transparent;
        border: 2px solid #181a9e;
        color: #181a9e;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 2px 8px;
        font-size: 14px;
    }

    .btn-gradient-outline:hover {
        background: linear-gradient(45deg, #181a9e, #172496);
        color: #fff;
        transform: translateY(-2px);
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }

    .cart-total {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }

    .table td {
        vertical-align: middle;
    }

    .product-image {
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.05);
    }
</style>

<body>
    @include('helpers.navbar')

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

    <div class="site-section">
        <div class="container">
            <h2>{{ __('messages.cart') }}</h2>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @php
                $cart = \App\Models\Cart::where('session_id', session()->getId())->first();
                $cartItems = $cart ? $cart->items()->with('product')->get() : collect();
                $grandTotal = 0;
            @endphp


            @if ($cartItems->count() > 0)
                <form action="{{ route('cart.update', app()->getLocale()) }}" method="POST" id="cart-form">
                    @csrf

                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>{{ __('messages.image') }}</th>
                                <th>{{ __('messages.product_name') }}</th>
                                <th>{{ __('messages.price') }}</th>
                                <th>{{ __('messages.quantity') }}</th>
                                <th>{{ __('messages.total') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                @php
                                    $itemTotal = $item->product->price * $item->quantity;
                                    $grandTotal += $itemTotal;
                                @endphp
                                <tr data-id="{{ $item->id }}">
                                    <td>
                                        <img src="{{ asset('storage/' . $item->product->image) }}" width="80"
                                            class="product-image" alt="{{ $item->product->name_uz }}">
                                    </td>
                                    <td>{{ $item->product->{'name_' . app()->getLocale()} }}</td>

                                    <td class="unit-price" data-price="{{ $item->product->price }}">
                                        {{ number_format($item->product->price) }} uzs
                                    </td>
                                    <td>
                                        <div class="quantity-controls">
                                            <button type="button"
                                                class="btn btn-gradient-outline btn-sm qty-minus">−</button>
                                            <input type="number" name="quantities[{{ $item->id }}]"
                                                value="{{ $item->quantity }}" min="1" class="quantity-input"
                                                data-item-id="{{ $item->id }}">
                                            <button type="button"
                                                class="btn btn-gradient-outline btn-sm qty-plus">+</button>
                                        </div>
                                    </td>
                                    <td class="item-total">
                                        {{ number_format($itemTotal) }} uzs
                                    </td>
                                    <td>
                                        <a href="{{ route('cart.remove', ['locale' => app()->getLocale(), 'id' => $item->product_id]) }}"
                                            class="btn btn-danger btn-sm">
                                            {{ __('messages.cart_remove') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="cart-total">
                                <div class="d-flex justify-content-between">
                                    <strong>Grand Total:</strong>
                                    <strong class="grand-total">{{ number_format($grandTotal) }} uzs</strong>
                                </div>
                                <hr>
                                <div class="mt-3">
                                    <a href="{{ route('store', app()->getLocale()) }}"
                                        class="btn btn-outline-secondary mr-2">{{ __('messages.continue_shopping') }}</a>
                                    <button type="button" id="checkout-btn" class="btn btn-gradient">
                                        {{ __('messages.formalization') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="text-center py-5">
                    <h4>{{ __('messages.cart_empty') }}</h4>
                    <p>{{ __('messages.empty_message') }}</p>
                    <a href="{{ route('store', app()->getLocale()) }}" class="btn btn-gradient">
                        {{ __('messages.go_to_store') }}
                    </a>
                </div>
            @endif
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
                                <a href="https://www.google.com/maps/search/?api=1&query=Your+Address" target="_blank">
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
            let quantitiesChanged = false;

            function updateTotals() {
                let grandTotal = 0;
                $('.quantity-input').each(function() {
                    const row = $(this).closest('tr');
                    const quantity = parseInt($(this).val()) || 1;
                    const unitPrice = parseFloat(row.find('.unit-price').data('price'));
                    const itemTotal = unitPrice * quantity;
                    row.find('.item-total').text(itemTotal.toLocaleString() + ' uzs');
                    grandTotal += itemTotal;
                });
                $('.grand-total').text(grandTotal.toLocaleString() + ' uzs');
            }

            $(document).on('click', '.qty-plus', function(e) {
                e.preventDefault();
                const input = $(this).siblings('.quantity-input');
                let currentVal = parseInt(input.val()) || 1;
                input.val(currentVal + 1);
                updateTotals();
                quantitiesChanged = true;
            });

            $(document).on('click', '.qty-minus', function(e) {
                e.preventDefault();
                const input = $(this).siblings('.quantity-input');
                let currentVal = parseInt(input.val()) || 1;
                if (currentVal > 1) {
                    input.val(currentVal - 1);
                    updateTotals();
                    quantitiesChanged = true;
                }
            });

            $(document).on('input', '.quantity-input', function() {
                let quantity = parseInt($(this).val());
                if (quantity < 1 || isNaN(quantity)) {
                    $(this).val(1);
                }
                updateTotals();
                quantitiesChanged = true;
            });

            // Update cart button
            $('#update-cart-btn').on('click', function() {
                $('#cart-form').submit();
            });

            // Checkout button - update cart first if needed, then redirect
            $('#checkout-btn').on('click', function(e) {
                e.preventDefault();
                
                if (quantitiesChanged) {
                    // Save quantities via AJAX first
                    const formData = $('#cart-form').serialize();
                    
                    $.ajax({
                        url: $('#cart-form').attr('action'),
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            // Redirect to checkout after updating
                            window.location.href = '{{ route("checkout", app()->getLocale()) }}';
                        },
                        error: function() {
                            alert('Error updating cart. Please try again.');
                        }
                    });
                } else {
                    // No changes, go directly to checkout
                    window.location.href = '{{ route("checkout", app()->getLocale()) }}';
                }
            });
        });
    </script>
</body>

</html>