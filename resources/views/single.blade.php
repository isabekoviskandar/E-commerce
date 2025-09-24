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

                    <p><strong class="text-primary h4">{{ $product->price }} uzs</strong></p>

                    <form action="{{ route('cart.add', ['locale' => app()->getLocale(), 'id' => $product->id]) }}"
                        method="POST">
                        @csrf
                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 220px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="number" name="quantity" class="form-control text-center" value="1"
                                    min="1" placeholder="" aria-label="Example text with button addon"
                                    aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>
                        </div>

                        <p><button type="submit" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Add
                                To Cart</button></p>
                    </form>

                    <div class="mt-5">
                        <ul class="nav nav-pills mb-3 custom-pill" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Product
                                    Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile"
                                    aria-selected="false">Specifications</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <table class="table custom-table">
                                    <thead>
                                        <th>Property</th>
                                        <th>Value</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Product Name</td>
                                            <td>{{ $product->name_uz }}</td>
                                        </tr>
                                        <tr>
                                            <td>Price</td>
                                            <td>{{ $product->price }} uzs</td>
                                        </tr>
                                        @if ($product->category)
                                            <tr>
                                                <td>Category</td>
                                                <td>{{ $product->category->name_uz }}</td>
                                            </tr>
                                        @endif
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
