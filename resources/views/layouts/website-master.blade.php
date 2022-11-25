<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('website/images/fav.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('website/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/prettyPhoto.css') }}">
    <!--Rev Slider Start-->
    <link rel="stylesheet" href="{{ asset('website/js/rev-slider/css/settings.css') }}" type='text/css' media='all' />
    <link rel="stylesheet" href="{{ asset('website/js/rev-slider/css/layers.css') }}" type='text/css' media='all' />
    <link rel="stylesheet" href="{{ asset('website/js/rev-slider/css/navigation.css') }}" type='text/css' media='all' />
    <!--Rev Slider End-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <title>@yield('title') - Daily Sports Update</title>
</head>

<body>
<!--Wrapper Start-->
<div class="wrapper gray-bg">

    <!-- SportMatch Counter Start -->
    @yield('match-counter')


    <!--Header Start-->
    <header id="main-header" class="main-header white-header">
        <!--Logo + Navbar Start-->
        <div class="logo-navbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-5">
                        <div class="logo"><a href="{{ route('/') }}"><img src="{{ asset('website/images/logo-dark.png') }}" alt=""></a></div>
                    </div>
                    <div class="col-md-10 col-sm-7">
                        <nav class="main-nav">
                            <ul>
                                <li class="nav-item"><a href="{{ route('/') }}">Home</a></li>
                                <li class="nav-item"><a href="{{ route('website/news/index') }}">News</a></li>
                                <li class="nav-item"><a href="{{ route('website/contact/index') }}">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--Logo + Navbar End-->
    </header>
    <!--Header End-->

    <!--Main Content Start-->
    @yield('content')
    <!--Main Content End-->
    <!--Main Footer Start-->
    <footer class="wf100 main-footer">
        <div class="container">
            <div class="row">
                <!--Footer Widget Start-->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget about-widget"> <img src="{{ asset('website/images/logo.png') }}" alt="">
                        <p> Fusce ac pharetra urna. Duis non lacus sit amet lacus interdum facilisis sed non est ut mi metus
                            semper. </p>
                        <address>
                            <ul>
                                <li><i class="fas fa-map-marker-alt"></i> 4700 Millenia Blvd # 175, Orlando, FL 32839, USA</li>
                                <li><i class="fas fa-phone"></i> +1 321 2345 678-7</li>
                                <li><i class="fas fa-envelope"></i> info@soccer.com</li>
                            </ul>
                        </address>
                    </div>
                </div>
                <!--Footer Widget End-->
                <!--Footer Widget Start-->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4>About Soccer</h4>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> About Club</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Matche Schedules</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Groups Table</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Teams</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Statistics</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Qualifiers</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Ticket Bookings</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Shoes</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> T-Shirts</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Sports Wear</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Accessories</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Shop</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Contact us</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i> Media Room</a></li>
                        </ul>
                    </div>
                </div>
                <!--Footer Widget End-->
                <!--Footer Widget Start-->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4>Recent Instagram</h4>
                        <ul class="instagram">
                            <li><img src="{{ asset('website/images/insta1.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('website/images/insta2.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('website/images/insta3.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('website/images/insta4.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('website/images/insta5.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('website/images/insta6.jpg') }}" alt=""></li>
                        </ul>
                    </div>
                </div>
                <!--Footer Widget End-->
                <!--Footer Widget Start-->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4>Get Updated</h4>
                        <p> Sign up to Get Updated & latest offers with our Newsletter. </p>
                        <ul class="newsletter">
                            <li>
                                <input type="text" class="form-control" placeholder="Your Name">
                            </li>
                            <li>
                                <input type="text" class="form-control" placeholder="Your Emaill Address">
                            </li>
                            <li> <strong>We respect your privacy</strong>
                                <button><span>Subscribe</span></button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--Footer Widget End-->
            </div>
        </div>
        <div class="container brtop">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <p class="copyr"> All Rights Reserved of Live Sports © 2022
                    </p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <ul class="quick-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--Main Footer End-->
</div>
<!--Wrapper End-->
<!-- Optional JavaScript -->
<script src="{{ asset('website/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('website/js/jquery-migrate-3.0.1.js') }}"></script>
<script src="{{ asset('website/js/popper.min.js') }}"></script>
<script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('website/js/mobile-nav.js') }}"></script>
<script src="{{ asset('website/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('website/js/isotope.js') }}"></script>
<script src="{{ asset('website/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('website/js/jquery.countdown.js') }}"></script>
<script src="{{ asset('website/js/custom.js') }}"></script>
<!--Rev Slider Start-->
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/js/rev-slider/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@yield('script')
</body>

</html>
