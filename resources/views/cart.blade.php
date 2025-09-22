<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping Cart &mdash; Pharmative</title>
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
                        <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
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
                                <li><a href="/">Home</a></li>
                                <li><a href="/store">Store</a></li>
                                <li><a href="/about">About</a></li>
                                <li><a href="/contact">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="icons">
                        <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                        <a href="{{ route('cart.index') }}" class="icons-btn d-inline-block bag">
                            <span class="icon-shopping-bag"></span>
                            <span class="number">{{ count(session('cart', [])) }}</span>
                        </a>
                        <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <a href="/">Home</a> <span class="mx-2 mb-0">/</span> 
                        <strong class="text-black">Cart</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                @if(session('cart') && count(session('cart')) > 0)
                    <div class="row mb-5">
                        <form class="col-md-12" method="post" action="{{ route('cart.update') }}">
                            @csrf
                            <div class="site-blocks-table">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-total">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach(session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity']; @endphp
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="img-fluid">
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black">{{ $details['name'] }}</h2>
                                                </td>
                                                <td>{{ number_format($details['price']) }} uzs</td>
                                                <td>
                                                    <div class="input-group mb-3" style="max-width: 120px;">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-outline-primary js-btn-minus" type="button" data-id="{{ $id }}">&minus;</button>
                                                        </div>
                                                        <input type="number" name="quantity[{{ $id }}]" class="form-control text-center quantity-input" value="{{ $details['quantity'] }}" min="1" data-id="{{ $id }}">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-primary js-btn-plus" type="button" data-id="{{ $id }}">&plus;</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="item-total">{{ number_format($details['price'] * $details['quantity']) }} uzs</td>
                                                <td>
                                                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-primary height-auto btn-sm" onclick="return confirm('Are you sure you want to remove this item?')">X</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-5">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <button type="submit" form="cart-form" class="btn btn-primary btn-md btn-block">Update Cart</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('store') }}" class="btn btn-outline-primary btn-md btn-block">Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pl-5">
                            <div class="row justify-content-end">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12 text-right border-bottom mb-5">
                                            <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <span class="text-black">Subtotal</span>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <strong class="text-black cart-subtotal">{{ number_format($total) }} uzs</strong>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <span class="text-black">Total</span>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <strong class="text-black cart-total">{{ number_format($total) }} uzs</strong>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-lg btn-block" onclick="window.location='#'">Proceed To Checkout</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="alert alert-info">
                                <h4>Your Cart is Empty</h4>
                                <p>Looks like you haven't added any items to your cart yet.</p>
                                <a href="{{ route('store') }}" class="btn btn-primary">Start Shopping</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <footer class="site-footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="block-7">
                            <h3 class="footer-heading mb-4">About <strong class="text-primary">Pharmative</strong></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis distinctio
                                voluptates sed dolorum excepturi iure eaque, aut unde.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
                        <h3 class="footer-heading mb-4">Navigation</h3>
                        <ul class="list-unstyled">
                            <li><a href="#">Supplements</a></li>
                            <li><a href="#">Vitamins</a></li>
                            <li><a href="#">Diet &amp; Nutrition</a></li>
                            <li><a href="#">Tea &amp; Coffee</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="block-5 mb-5">
                            <h3 class="footer-heading mb-4">Contact Info</h3>
                            <ul class="list-unstyled">
                                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                                <li class="email">emailaddress@domain.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <p>
                            Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script> 
                            All rights reserved | This template is made with 
                            <i class="icon-heart text-danger" aria-hidden="true"></i> by 
                            <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <form id="cart-form" method="POST" action="{{ route('cart.update') }}" style="display: none;">
        @csrf
        <input type="hidden" id="update-quantities" name="quantities" value="">
    </form>

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
            // Handle quantity changes
            $('.js-btn-plus').click(function() {
                var input = $(this).closest('.input-group').find('.quantity-input');
                var currentValue = parseInt(input.val());
                input.val(currentValue + 1);
                updateItemTotal($(this).data('id'));
            });

            $('.js-btn-minus').click(function() {
                var input = $(this).closest('.input-group').find('.quantity-input');
                var currentValue = parseInt(input.val());
                if (currentValue > 1) {
                    input.val(currentValue - 1);
                    updateItemTotal($(this).data('id'));
                }
            });

            $('.quantity-input').change(function() {
                updateItemTotal($(this).data('id'));
            });

            function updateItemTotal(productId) {
                var row = $('input[data-id="' + productId + '"]').closest('tr');
                var quantity = parseInt($('input[data-id="' + productId + '"]').val());
                var price = parseFloat(row.find('td:nth-child(3)').text().replace(/[^\d.-]/g, ''));
                var total = quantity * price;
                
                row.find('.item-total').text(new Intl.NumberFormat().format(total) + ' uzs');
                updateCartTotal();
            }

            function updateCartTotal() {
                var grandTotal = 0;
                $('.item-total').each(function() {
                    var itemTotal = parseFloat($(this).text().replace(/[^\d.-]/g, ''));
                    grandTotal += itemTotal;
                });
                
                $('.cart-subtotal, .cart-total').text(new Intl.NumberFormat().format(grandTotal) + ' uzs');
            }
        });
    </script>
</body>

</html>