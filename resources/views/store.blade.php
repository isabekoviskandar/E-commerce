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

    <style>
        /* Enhanced Product Card Styles */
        .product-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 30px;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            position: relative;
            overflow: hidden;
            height: 250px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        /* File Badge */
        .product-file-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(45deg, #28a745, #218838);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 5px;
            z-index: 2;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
            transition: all 0.3s ease;
        }

        .product-file-badge:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
        }

        .product-file-badge svg {
            width: 14px;
            height: 14px;
        }

        .product-info {
            padding: 25px 20px;
            text-align: center;
        }

        .product-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.4;
            transition: color 0.3s ease;
        }

        .product-title:hover {
            color: #007bff;
            text-decoration: none;
        }

        .product-price {
            font-size: 24px;
            font-weight: 700;
            color: #28a745;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .product-price::after {
            content: 'UZS';
            font-size: 14px;
            font-weight: 500;
            color: #6c757d;
        }

        .product-category {
            background: #f8f9fa;
            color: #6c757d;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 12px;
            display: inline-block;
            margin-bottom: 15px;
            text-transform: uppercase;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .category-scroll::-webkit-scrollbar {
            height: 4px;
        }

        .category-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
        }

        .category-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .category-pill {
            color: rgb(0, 0, 0);
            padding: 5px 10px;
            border-radius: 25px;
            text-decoration: none;
            white-space: nowrap;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .category-pill.active {
            background: white;
            color: #000000;
            font-weight: 600;
            border-color: white;
        }

        /* Download File Button */
        .btn-download-file {
            background: linear-gradient(45deg, #28a745, #218838);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 10px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-decoration: none;
            width: 100%;
        }

        .btn-download-file:hover {
            background: linear-gradient(45deg, #218838, #1e7e34);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-download-file svg {
            width: 14px;
            height: 14px;
            transition: transform 0.3s ease;
        }

        .btn-download-file:hover svg {
            transform: translateY(2px);
        }

        /* Add to Cart Button */
        .add-to-cart-form {
            margin-top: 10px;
        }

        .btn-add-to-cart {
            background: linear-gradient(45deg, #181a9e, #172496);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-add-to-cart:hover {
            background: linear-gradient(45deg, #1b1da8, #1ea085);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(17, 56, 139, 0.3);
        }

        .btn-add-to-cart:active {
            transform: translateY(0);
        }

        .btn-add-to-cart svg {
            transition: transform 0.3s ease;
        }

        .btn-add-to-cart:hover svg {
            transform: scale(1.1);
        }

        /* No Products Message */
        .no-products {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            margin: 40px 0;
        }

        .no-products h4 {
            color: #495057;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .no-products p {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 25px;
        }

        .no-products .btn {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .no-products .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        /* Carousel Styles */
        .carousel-item {
            height: 410px;
        }

        .carousel-item img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .product-card {
                margin-bottom: 25px;
            }

            .categories-horizontal {
                padding: 15px;
                margin-bottom: 25px;
            }

            .category-pill {
                padding: 8px 16px;
                font-size: 14px;
            }

            .product-info {
                padding: 20px 15px;
            }

            .product-title {
                font-size: 16px;
            }

            .product-price {
                font-size: 20px;
            }

            .btn-add-to-cart {
                padding: 8px 16px;
                font-size: 13px;
            }

            .btn-download-file {
                padding: 7px 14px;
                font-size: 12px;
            }

        }
    </style>
</head>

<body>

    @include('helpers.navbar')

    <div class="py-4">
        <div class="container">
            <div class="categories-horizontal">
                <div class="category-scroll">
                    <a href="{{ route('store', app()->getLocale()) }}"
                        class="category-pill {{ request('category_id') ? '' : 'active' }}">
                        {{ __('messages.all_categories') }}
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('store', array_merge(['locale' => app()->getLocale()], ['category_id' => $category->id])) }}"
                            class="category-pill {{ request('category_id') == $category->id ? 'active' : '' }}">
                            {{ $category->{'name_' . app()->getLocale()} }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container carousel-container">
        <div id="carouselExampleRide" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($slider_products as $key => $product)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <a
                            href="{{ route('product.single', ['locale' => app()->getLocale(), 'id' => $product->id]) }}">
                            <img src="{{ asset('storage/' . ($product->image1 ?? 'default.png')) }}"
                                alt="{{ $product->name_uz }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#carouselExampleRide" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleRide" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <div class="col-sm-6 col-lg-4">
                            <div class="product-card">
                                <div class="product-image">
                                    <a
                                        href="{{ route('product.single', ['locale' => app()->getLocale(), 'id' => $product->id]) }}">
                                        <img src="{{ asset('storage/' . ($product->image1 ?? 'default.png')) }}"
                                            alt="{{ $product->{'name_' . app()->getLocale()} }}">
                                    </a>

                                    {{-- File Badge - shows if product has a file --}}
                                    {{-- @if ($product->file)
                                        <div class="product-file-badge">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{ __('messages.has_file') }}
                                        </div>
                                    @endif --}}
                                </div>

                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a
                                            href="{{ route('product.single', ['locale' => app()->getLocale(), 'id' => $product->id]) }}">
                                            {{ $product->{'name_' . app()->getLocale()} }}
                                        </a>
                                    </h3>

                                    <div class="product-price">{{ number_format($product->price) }}</div>



                                    <form
                                        action="{{ route('cart.add', ['locale' => app()->getLocale(), 'id' => $product->id]) }}"
                                        method="POST" class="add-to-cart-form">
                                        @csrf
                                        <button type="submit" class="btn-add-to-cart">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.7 15.3C4.3 15.7 4.6 16 5 16H17M17 13V17C17 17.6 16.6 18 16 18H8C7.4 18 7 17.6 7 17V13"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <circle cx="9" cy="20" r="1" stroke="currentColor"
                                                    stroke-width="2" />
                                                <circle cx="20" cy="20" r="1" stroke="currentColor"
                                                    stroke-width="2" />
                                            </svg>
                                            {{ __('messages.add_to_cart') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="no-products">
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
                        @foreach ($footer_categories as $category)
                            <li>
                                <a href="{{ route('store', app()->getLocale(), ['category_id' => $category->id]) }}">
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
                                <a
                                    href="mailto:abdushukurtabiboriginal@gmail.com">abdushukurtabiboriginal@gmail.com</a>
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
</body>

</html>
