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

<style>
    /* Custom styles for cart */
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

        <!-- Cart Content -->
        <div class="site-section">
            <div class="container">
                <h2>{{ __('messages.cart') }}</h2>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(!empty($cart))
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
                                    <th>{{ __('messages.actions') ?? 'Actions' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @foreach($cart as $id => $item)
                                    @php $itemTotal = $item['price'] * $item['quantity']; @endphp
                                    @php $grandTotal += $itemTotal; @endphp
                                    <tr data-product-id="{{ $id }}">
                                        <td>
                                            <img src="{{ asset('storage/' . $item['image']) }}" 
                                                 width="80" 
                                                 class="product-image"
                                                 alt="{{ $item['name'] }}">
                                        </td>
                                        <td>{{ $item['name'] }}</td>
                                        <td class="unit-price" data-price="{{ $item['price'] }}">
                                            {{ number_format($item['price']) }} uzs
                                        </td>
                                        <td>
                                            <div class="quantity-controls">
                                                <button type="button" class="btn btn-gradient-outline btn-sm qty-minus">−</button>
                                                <input type="number" 
                                                       name="quantities[{{ $id }}]" 
                                                       value="{{ $item['quantity'] }}" 
                                                       min="1" 
                                                       class="quantity-input">
                                                <button type="button" class="btn btn-gradient-outline btn-sm qty-plus">+</button>
                                            </div>
                                        </td>
                                        <td class="item-total">
                                            {{ number_format($itemTotal) }} uzs
                                        </td>
                                        <td>
                                            <a href="{{ route('cart.remove', [app()->getLocale(), $id]) }}" 
                                               class="btn btn-danger-outline btn-sm"
                                               onclick="return confirm('Are you sure you want to remove this item?')">
                                                Remove
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-gradient mr-3">Update Cart</button>
                                    <a href="{{ route('cart.clear', app()->getLocale()) }}" 
                                       class="btn btn-danger-outline"
                                       onclick="return confirm('Are you sure you want to clear the cart?')">
                                        Clear Cart
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="cart-total">
                                    <h4>Cart Summary</h4>
                                    <div class="d-flex justify-content-between">
                                        <strong>Grand Total:</strong>
                                        <strong class="grand-total">{{ number_format($grandTotal) }} uzs</strong>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <a href="{{ route('store', app()->getLocale()) }}" class="btn btn-outline-secondary mr-2">Continue Shopping</a>
                                        <button type="button" class="btn btn-gradient">Proceed to Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="text-center py-5">
                        <h4>{{ __('messages.cart_empty') }}</h4>
                        <p>Your cart is currently empty. Start shopping to add items to your cart.</p>
                        <a href="{{ route('store', app()->getLocale()) }}" class="btn btn-gradient">Go to Store</a>
                    </div>
                @endif
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

    <script>
        $(document).ready(function() {
            // Function to update item total and grand total
            function updateTotals() {
                let grandTotal = 0;
                
                $('.quantity-input').each(function() {
                    const row = $(this).closest('tr');
                    const quantity = parseInt($(this).val()) || 1;
                    const unitPrice = parseFloat(row.find('.unit-price').data('price'));
                    const itemTotal = unitPrice * quantity;
                    
                    // Update item total
                    row.find('.item-total').text(itemTotal.toLocaleString() + ' uzs');
                    
                    // Add to grand total
                    grandTotal += itemTotal;
                });
                
                // Update grand total
                $('.grand-total').text(grandTotal.toLocaleString() + ' uzs');
            }

            // Plus button click handler
            $(document).on('click', '.qty-plus', function(e) {
                e.preventDefault();
                const input = $(this).siblings('.quantity-input');
                let currentVal = parseInt(input.val()) || 1;
                input.val(currentVal + 1);
                updateTotals();
            });

            // Minus button click handler
            $(document).on('click', '.qty-minus', function(e) {
                e.preventDefault();
                const input = $(this).siblings('.quantity-input');
                let currentVal = parseInt(input.val()) || 1;
                if (currentVal > 1) {
                    input.val(currentVal - 1);
                    updateTotals();
                }
            });

            // Handle manual input changes
            $(document).on('input', '.quantity-input', function() {
                let quantity = parseInt($(this).val());
                
                // Ensure minimum quantity is 1
                if (quantity < 1 || isNaN(quantity)) {
                    quantity = 1;
                    $(this).val(1);
                }
                
                updateTotals();
            });

            // Auto-submit form on quantity change (optional)
            // Uncomment if you want automatic updates
            /*
            $(document).on('change', '.quantity-input', function() {
                $('#cart-form').submit();
            });
            */
        });
    </script>
</body>
</html>