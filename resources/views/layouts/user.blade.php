<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pemerintah Kabupaten Mojokerto</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('images/kominfo.png') }}" rel="icon">
    <link href="{{ asset('images/kominfo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>

    <body>

    <!-- ======= Mobile nav toggle button ======= -->
    <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    <!-- ======= Header ======= -->
    <header id="header" style="background-color: #030225;">
        <div class="d-flex flex-column">

        <div class="profile">
            <img src="https://www.cendananews.com/wp-content/uploads/2019/08/logo-kominfo.jpg" alt="" class="img-fluid rounded-circle" style="height: 120px;">
            <h1 class="text-light"><a href="index.html">Diskominfo</a></h1>
            <div class="social-links mt-3 text-center">
            <a href="https://twitter.com/kominfokabmoker?lang=en" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="https://www.facebook.com/pages/category/Government-Organization/Diskominfo-Kabupaten-Mojokerto-110915657046635/" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://www.instagram.com/kominfokab_mojokerto/?hl=en" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="tel:(0321) 391268" class="google-plus"><i class="bx bxs-phone"></i></a>
            <a href="mailto:diskominfo@mojokertokab.go.id" class="linkedin"><i class="bx bx-envelope"></i></a>
            </div>
        </div>

        <nav class="nav-menu">
            <ul>
            <li class="active"><a href="#hero"><i class="bx bx-home"></i> <span>Home</span></a></li>
            <li><a href="#about"><i class="bx bx-map"></i> <span>Tower Maps</span></a></li>
            <li><a href="#resume"><i class="bx bx-file-blank"></i> <span> Statistic </span></a></li>
            {{-- <li><a href="#portfolio"><i class="bx bx-book-content"></i> tower Location </a></li>
            <li><a href="#services"><i class="bx bx-server"></i> Tower Details </a></li> --}}
            <li><a href="{{ route('login') }}"><i class="bx bx-user"></i> Login</a></li>

            </ul>
        </nav><!-- .nav-menu -->
        <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

        </div>
    </header><!-- End Header -->

    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="hero-container" data-aos="fade-in">
            <h1>DISKOMINFO</h1>
            <p><span class="typed" data-typed-items="DINAS KOMUNIKASI DAN INFORMATIKA, KABUPATEN MOJOKERTO"></span></p>
        </div>
    </section><!-- End Hero -->
    <main id="main">
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>Diskominfo 2021</span></strong>
        </div>
        {{-- <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div> --}}
        </div>
    </footer><!-- End  Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery.easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('vendor/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('vendor/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('vendor/venobox/venobox.min.js')}}"></script>
    <script src="{{asset('vendor/owl.carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('vendor/typed.js/typed.min.js')}}"></script>
    <script src="{{asset('vendor/aos/aos.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

    @yield('script')
</body>

</html>
