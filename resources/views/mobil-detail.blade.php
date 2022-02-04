<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Suzuki Car</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('front/assets/img/suzuki.png') }}" rel="icon">
  <link href="{{ asset('front/assets/img/suzuki.png') }}" rel="suzuki">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('front/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('front/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Dewi - v4.5.0
  * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="{{ route('front') }}">Suzuki Car</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="{{ route('front') }}" class="logo"><img src="{{ asset('front/assets/img/logo.png') }}" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="{{ route('front') }}">Home</a></li>
          <li><a class="nav-link scrollto active" href="{{ route('front.mobil') }}">Mobil</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="getstarted scrollto" href="https://api.whatsapp.com/send/?phone=6288222555835&text&app_absent=0" target="_blank">Hubungi Sales</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Harga Mobil {{ $mobil->tipe }}</h2>
          <ol>
            <li><a href="{{ route('front') }}">Home</a></li>
            <li><a href="{{ route('front.mobil') }}">Mobil</a></li>
            <li>Harga Mobil</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="text-center mb-3">
          <img src="{{ asset('gambar/'.$mobil->gambar) }}" width="600px" class="rounded img-fluid" alt="...">
        </div>

        <div class="row">

          <div class="col-12">
            <div class="accordion" id="accordionExample">
              @foreach($bank as $data)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading{{ $data->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $data->id }}" aria-expanded="true" aria-controls="collapse{{ $data->id }}">
                      {{ $data->nama }}
                    </button>
                  </h2>
                  <div id="collapse{{ $data->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $data->id }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="table-responsive">
                        <table class="table table-striped" width="100%">
                          <tr>
                            <th>Harga</th>
                            <th>Tenor</th>
                            <th>Bunga</th>
                            <th>DP</th>
                            <th>TDP</th>
                            <th>Angsuran</th>
                          </tr>
                            @foreach($harga->where('bank_id', $data->id) as $value)
                              <tr>
                                <td>Rp. {{ number_format($value->harga, 0) }},-</td>
                                <td>{{ $value->tenor }}</td>
                                <td>{{ $value->bunga_persen }} %</td>
                                <td>{{ $value->dp_persen }} %</td>
                                <td>Rp. {{ number_format($value->dp_nominal, 0) }},-</td>
                                <td>Rp. {{ number_format($value->angsuran, 0) }},-</td>
                              </tr>
                            @endforeach
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Suzuki Car</h3>
              <p>
                A108 Adam Street <br>
                NY 535022, USA<br><br>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.mobil') }}">Mobil</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Suzuki Car</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('front/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('front/assets/js/main.js') }}"></script>

</body>

</html>