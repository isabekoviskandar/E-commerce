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
    }

    .btn-gradient-outline:hover {
        background: linear-gradient(45deg, #181a9e, #172496);
        color: #fff;
        transform: translateY(-2px);
    }

    .thumbnail-wrapper {
        transition: all 0.3s ease;
    }

    .thumbnail-wrapper:hover {
        border-color: #181a9e !important;
        transform: scale(1.05);
    }

    .thumbnail-image {
        transition: opacity 0.3s ease;
    }

    #main-image {
        transition: transform 0.3s ease;
        cursor: zoom-in;
    }

    #main-image:hover {
        transform: scale(1.03);
    }

    @media (max-width: 768px) {
        .thumbnail-wrapper {
            width: 60px !important;
            height: 60px !important;
        }
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
                    <strong class="text-black">{{ $product->{'name_' . app()->getLocale()} }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mr-auto">
                    @php
                        $mainImage = $product->image1 ?? $product->image2 ?? $product->image3 ?? null;
                    @endphp
                    <div class="border text-center mb-3">
                        @if ($mainImage)
                            <img id="main-image" src="{{ asset('storage/' . $mainImage) }}" alt="{{ $product->name_uz }}"
                                class="img-fluid p-5">
                        @else
                            <img id="main-image" src="{{ asset('images/default.png') }}" alt="No image"
                                class="img-fluid p-5">
                        @endif
                    </div>

                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        @foreach ([$product->image1, $product->image2, $product->image3] as $img)
                            @if ($img)
                                <div class="border thumbnail-wrapper"
                                    style="cursor:pointer; padding:8px; width:80px; height:80px;">
                                    <img src="{{ asset('storage/' . $img) }}" class="img-fluid thumbnail-image"
                                        data-image="{{ asset('storage/' . $img) }}"
                                        style="width:100%; height:100%; object-fit:contain;">
                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="d-flex justify-content-center gap-2">
                        @if($product->image1)
                        <div class="border thumbnail-wrapper" style="cursor: pointer; padding: 10px; width: 80px; height: 80px;">
                            <img src="{{ asset('storage/' . $product->image1) }}" 
                                 class="img-fluid thumbnail-image" 
                                 data-image="{{ asset('storage/' . $product->image1) }}"
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        @endif
                        
                        @if($product->image2)
                        <div class="border thumbnail-wrapper" style="cursor: pointer; padding: 10px; width: 80px; height: 80px; margin-left: 10px;">
                            <img src="{{ asset('storage/' . $product->image2) }}" 
                                 class="img-fluid thumbnail-image" 
                                 data-image="{{ asset('storage/' . $product->image2) }}"
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        @endif
                        
                        @if($product->image3)
                        <div class="border thumbnail-wrapper" style="cursor: pointer; padding: 10px; width: 80px; height: 80px; margin-left: 10px;">
                            <img src="{{ asset('storage/' . $product->image3) }}" 
                                 class="img-fluid thumbnail-image" 
                                 data-image="{{ asset('storage/' . $product->image3) }}"
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <h2 class="text-black">{{ $product->{'name_' . app()->getLocale()} }}</h2>

                    @if ($product->{'description_' . app()->getLocale()})
                        <p>{{ $product->{'description_' . app()->getLocale()} }}</p>
                    @endif

                    <div class="price-section mb-3">
                        <p><strong class="text-primary h4 total-price">{{ number_format($product->price, 0, '.', ' ') }}
                                uzs</strong></p>
                    </div>

                    <form action="{{ route('cart.add', ['locale' => app()->getLocale(), 'id' => $product->id]) }}"
                        method="POST">
                        @csrf
                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 220px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-gradient-outline js-btn-minus" type="button">&minus;</button>
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
                                {{ __('messages.add_to_cart') }}
                            </button>
                        </p>
                    </form>

                    <div class="mt-5">
                        <table class="table custom-table">
                            <tbody>
                                <tr>
                                    <td>{{ __('messages.single_product_name') }}</td>
                                    <td>{{ $product->{'name_' . app()->getLocale()} }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.single_product_price') }}</td>
                                    <td class="unit-price-table">{{ $product->price }} uzs</td>
                                </tr>
                                <tr>
                                    <td>{{ __('messages.single_product_country') }}</td>
                                    <td>{{ $product->{'country_' . app()->getLocale()} }}</td>
                                </tr>
                                @if ($product->category)
                                    <tr>
                                        <td>Category</td>
                                        <td>{{ $product->category->{'name_' . app()->getLocale()} }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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
                                    href="{{ route('store', app()->getLocale(), ['category_id' => $category->id]) }}">{{ $category->name_uz }}</a>
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
            const unitPrice = parseFloat('{{ $product->price }}'.replace(/[^\d.-]/g, ''));

            function updateTotalPrice() {
                const quantity = parseInt($('#quantity-input').val()) || 1;
                const totalPrice = unitPrice * quantity;
                $('.total-price').text(totalPrice.toLocaleString() + ' uzs');
                $('.unit-price-table').text(totalPrice.toLocaleString() + ' uzs');
            }

            $('.js-btn-plus').on('click', function(e) {
                e.preventDefault();
                const quantityInput = $('#quantity-input');
                quantityInput.val(parseInt(quantityInput.val()) + 1);
                updateTotalPrice();
            });

            $('.js-btn-minus').on('click', function(e) {
                e.preventDefault();
                const quantityInput = $('#quantity-input');
                const currentQuantity = parseInt(quantityInput.val());
                if (currentQuantity > 1) quantityInput.val(currentQuantity - 1);
                updateTotalPrice();
            });

            $('#quantity-input').on('input', function() {
                if (parseInt($(this).val()) < 1 || isNaN($(this).val())) $(this).val(1);
                updateTotalPrice();
            });

            $('.thumbnail-image').on('click', function() {
                const newImageSrc = $(this).data('image');
                $('#main-image').fadeOut(200, function() {
                    $(this).attr('src', newImageSrc).fadeIn(200);
                });
            });

            updateTotalPrice();

            // Image gallery functionality
            $('.thumbnail-image').on('click', function() {
                const newImageSrc = $(this).data('image');
                $('#main-image').fadeOut(200, function() {
                    $(this).attr('src', newImageSrc).fadeIn(200);
                });
            });
        });
    </script>
</body>

</html>