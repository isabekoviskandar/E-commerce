<!DOCTYPE html>
<html lang="en">

<head>
    <title>Abdushukur Jurayev Sinotip</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-G491H26105"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-C9X1B1MXDF');
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
        .hero-about {
            background: linear-gradient(135deg, #0fa842, #13973bc4);
            color: white;
            padding: 100px 0 80px;
            position: relative;
        }

        .hero-about::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>') repeat;
            opacity: 0.3;
        }

        .doctor-profile-img {
            width: 280px;
            height: 280px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            display: block;
        }

        .stat-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            display: block;
            margin-bottom: 5px;
        }

        .expertise-section {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .expertise-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
            height: 100%;
        }

        .expertise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .expertise-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
            color: white;
        }

        .timeline-section {
            padding: 80px 0;
            background: white;
        }

        .timeline {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #28a745;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1.5px;
        }

        .timeline-container {
            padding: 20px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        .timeline-container::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: #1bb13e;
            border: 4px solid white;
            top: 20px;
            border-radius: 50%;
            z-index: 1;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .timeline-left {
            left: 0;
        }

        .timeline-right {
            left: 50%;
        }

        .timeline-right::after {
            left: -10px;
        }

        .timeline-content {
            padding: 25px 30px;
            background-color: white;
            position: relative;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .social-media-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #0d9737, #119247c4);
            color: white;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 50%;
            text-decoration: none;
            margin: 0 10px;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .social-link:hover {
            background: white;
            color: #28a745;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            font-size: 2.5rem;
            font-weight: 700;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #28a745;
            border-radius: 2px;
        }

        @media screen and (max-width: 768px) {
            .timeline::after {
                left: 31px;
            }

            .timeline-container {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .timeline-container::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            .timeline-left::after,
            .timeline-right::after {
                left: 21px;
            }

            .timeline-right {
                left: 0%;
            }

            .doctor-profile-img {
                width: 220px;
                height: 220px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('helpers.navbar')


    <div class="hero-about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                    <img src="{{ asset('images/profile.jpg') }}" class="doctor-profile-img">
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <h1 class="display-4 font-weight-bold mb-4">{{ __('messages.full_name') }}</h1>
                    <h4 class="mb-4">{{ __('messages.specialist') }}</h4>
                    <p class="lead mb-4">{{ __('messages.info') }}</p>

                    <div class="row mt-5">
                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="stat-box">
                                <span class="stat-number">30+</span>
                                <small>{{ __('messages.years_experience') }}</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="stat-box">
                                <span class="stat-number">66</span>
                                <small>{{ __('messages.years_of_age') }}</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="stat-box">
                                <span class="stat-number">10+</span>
                                <small>{{ __('messages.cities_practiced') }}</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="site-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">{{ __('messages.personal_information') }}</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <span class="icon-calendar"></span>
                        </div>
                        <h5>{{ __('messages.date_of_birth') }}</h5>
                        <p class="text-muted">{{ __('messages.dob_value') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <h5>{{ __('messages.specialization') }}</h5>
                        <p class="text-muted">{{ __('messages.specialization_value') }}</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <span class="icon-globe"></span>
                        </div>
                        <h5>{{ __('messages.international_experience') }}</h5>
                        <p class="text-muted">{{ __('messages.international_experience_value') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="expertise-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">{{ __('messages.areas_of_expertise') }}</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <h4>{{ __('messages.clinical_nutrition') }}</h4>
                        <p>{{ __('messages.clinical_nutrition_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                        <h4>{{ __('messages.weight_management') }}</h4>
                        <p>{{ __('messages.weight_management_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <h4>{{ __('messages.holistic_wellness') }}</h4>
                        <p>{{ __('messages.holistic_wellness_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <h4>{{ __('messages.lifestyle_medicine') }}</h4>
                        <p>{{ __('messages.lifestyle_medicine_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                        <h4>{{ __('messages.sports_nutrition') }}</h4>
                        <p>{{ __('messages.sports_nutrition_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                        <h4>{{ __('messages.community_health') }}</h4>
                        <p>{{ __('messages.community_health_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="timeline-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">{{ __('messages.professional_journey') }}</h2>
            <div class="timeline">
                <div class="timeline-container timeline-left" data-aos="fade-right">
                    <div class="timeline-content">
                        <h4>{{ __('messages.timeline_early_title') }}</h4>
                        <p><strong>{{ __('messages.timeline_early_period') }}</strong></p>
                        <p>{{ __('messages.timeline_early_desc') }}</p>
                    </div>
                </div>

                <div class="timeline-container timeline-right" data-aos="fade-left">
                    <div class="timeline-content">
                        <h4>{{ __('messages.timeline_tibet_title') }}</h4>
                        <p><strong>{{ __('messages.timeline_tibet_period') }}</strong></p>
                        <p>{{ __('messages.timeline_tibet_desc') }}</p>
                    </div>
                </div>

                <div class="timeline-container timeline-left" data-aos="fade-right">
                    <div class="timeline-content">
                        <h4>{{ __('messages.timeline_sea_title') }}</h4>
                        <p><strong>{{ __('messages.timeline_sea_period') }}</strong></p>
                        <p>{{ __('messages.timeline_sea_desc') }}</p>
                    </div>
                </div>

                <div class="timeline-container timeline-right" data-aos="fade-left">
                    <div class="timeline-content">
                        <h4>{{ __('messages.timeline_india_title') }}</h4>
                        <p><strong>{{ __('messages.timeline_india_period') }}</strong></p>
                        <p>{{ __('messages.timeline_india_desc') }}</p>
                    </div>
                </div>

                <div class="timeline-container timeline-left" data-aos="fade-right">
                    <div class="timeline-content">
                        <h4>{{ __('messages.timeline_digital_title') }}</h4>
                        <p><strong>{{ __('messages.timeline_digital_period') }}</strong></p>
                        <p>{{ __('messages.timeline_digital_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="section-title">{{ __('messages.philosophy_title') }}</h2>
                    <blockquote class="blockquote text-center">
                        <p class="mb-4 lead">{{ __('messages.philosophy_quote') }}</p>
                        <footer class="blockquote-footer">{{ __('messages.philosophy_author') }}</footer>
                    </blockquote>

                    <div class="row mt-5">
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <span class="icon-check text-success" style="font-size: 1.5rem;"></span>
                                </div>
                                <div>
                                    <h5>{{ __('messages.personalized_care_title') }}</h5>
                                    <p>{{ __('messages.personalized_care_text') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <span class="icon-check text-success" style="font-size: 1.5rem;"></span>
                                </div>
                                <div>
                                    <h5>{{ __('messages.holistic_integration_title') }}</h5>
                                    <p>{{ __('messages.holistic_integration_text') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <span class="icon-check text-success" style="font-size: 1.5rem;"></span>
                                </div>
                                <div>
                                    <h5>{{ __('messages.sustainable_practices_title') }}</h5>
                                    <p>{{ __('messages.sustainable_practices_text') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <span class="icon-check text-success" style="font-size: 1.5rem;"></span>
                                </div>
                                <div>
                                    <h5>{{ __('messages.education_focus_title') }}</h5>
                                    <p>{{ __('messages.education_focus_text') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="social-media-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="mb-4">{{ __('messages.social_title') }}</h2>
                    <p class="lead mb-5">{{ __('messages.social_text') }}</p>

                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <a href="https://www.instagram.com/abdushukur_tabib?igsh=MWRhNzhoM2ZheXlpMw=="
                            class="social-link" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@Abdushukur_tabib" class="social-link" target="_blank">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="https://www.facebook.com/share/165SPhGpc5/" class="social-link" target="_blank">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
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

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });

        // Counter animation for stats
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = parseInt(counter.textContent.replace('+', ''));
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target + (counter.textContent.includes('+') ? '+' : '');
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current) + (counter.textContent.includes('+') ?
                            '+' : '');
                    }
                }, 40);
            });
        }

        // Trigger counter animation when hero section is in view
        const heroObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    setTimeout(animateCounters, 500);
                    heroObserver.unobserve(entry.target);
                }
            });
        });

        const heroSection = document.querySelector('.hero-about');
        if (heroSection) {
            heroObserver.observe(heroSection);
        }
    </script>
</body>

</html>
