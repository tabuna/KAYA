<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>



<div class="oz-body-wrap">
    <!-- Start Header Area -->
    <header class="default-header">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="https://orchid.software/img/orchid.svg" alt="" height="18px"></a>
                    </div>
                    <div class="main-menubar d-flex align-items-center">
                        <nav class="hide">
                            <a href="{{ url('/') }}"><i class="icon-home"></i> Главная</a>

                            @guest
                                <a href="{{ route('login') }}"><i class="icon-login"></i> {{ __('Login') }}</a>
                                <a href="{{ route('register') }}"><i class="icon-magnet"></i> {{ __('Register') }}</a>
                            @else
                                <a class="nav-menu" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="icon-logout"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest


                        </nav>
                        <div class="menu-bar"><span class="lnr lnr-menu icon-menu"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Area -->


    <main>
        <section class="banner-area relative">
            <div class="container">
                @yield('content')
            </div>
        </section>
    </main>

    <!-- Strat Footer Area -->
    <footer class="section-gap">
        <div class="container">
            <div class="row pt-60">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h6 class="text-uppercase mb-20">Top Product</h6>
                        <ul class="footer-nav">
                            <li><a href="#">Managed Website</a></li>
                            <li><a href="#">Manage Reputation</a></li>
                            <li><a href="#">Power Tools</a></li>
                            <li><a href="#">Marketing Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h6 class="text-uppercase mb-20">Navigation</h6>
                        <ul class="footer-nav">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Main Features</a></li>
                            <li><a href="#">Offered Services</a></li>
                            <li><a href="#">Latest Portfolio</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h6 class="text-uppercase mb-20">Compare</h6>
                        <ul class="footer-nav">
                            <li><a href="#">Works & Builders</a></li>
                            <li><a href="#">Works & Wordpress</a></li>
                            <li><a href="#">Works & Templates</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h6 class="text-uppercase mb-20">Quick About</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consecteturadipisicin gelit, sed do eiusmod tempor incididunt.
                        </p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="icon-facebook"></i></a>
                            <a href="#"><i class="icon-twitter"></i></a>
                            <a href="#"><i class="icon-dribbble"></i></a>
                            <a href="#"><i class="icon-social-vkontakte"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <p class="footer-text m-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script>
                                           Код приложения публикуется под лицензией MIT</p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </footer>
    <!-- End Footer Area -->
</div>

</body>
</html>
