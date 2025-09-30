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
                            @foreach ($footerCategories as $category)
                                <li>
                                    <a href="{{ route('store', ['category_id' => $category->id]) }}">
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
