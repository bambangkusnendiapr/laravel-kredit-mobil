<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Suzuki Car</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('depan/assets/img/suzuki.png') }}" rel="icon">
  <link href="{{ asset('depan/assets/img/suzuki.png') }}" rel="suzuki">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('depan/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('depan/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('depan/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('depan/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('depan/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('depan/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('depan/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizPage - v5.7.0
  * Template URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container-fluid">

      <div class="row justify-content-center align-items-center">
        <div class="col-xl-11 d-flex align-items-center justify-content-between">
          <h1 class="logo"><a href="{{ route('front') }}">Suzuki Car</a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html" class="logo"><img src="{{ asset('depan/assets/img/logo.png') }}" alt="" class="img-fluid"></a>-->

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto " href="{{ route('front') }}">Home</a></li>
              <li><a class="nav-link scrollto active" href="{{ route('front.mobil') }}">Mobil</a></li>
              <li><a class="nav-link scrollto" href="{{ route('front') }}#contact">Kontak</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 footer-info">
            <h3>Suzuki Car</h3>
          </div>

          <div class="col-lg-4 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('front') }}">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Mobil</a></li>
            </ul>
          </div>

          <div class="col-lg-4 footer-contact">
            <h4>Kontak Kami</h4>
            <p>
              Jl. Ahmad Yani No 259 Bandung<br>
              <strong>Phone:</strong> +62 8822 2555 835<br>
              <strong>Email:</strong> andrewbahari9@gmail.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Suzuki Car</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
      -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
  <script src="{{ asset('depan/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('depan/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('depan/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('depan/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('depan/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('depan/assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('depan/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('depan/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('depan/assets/js/main.js') }}"></script>

</body>

</html>