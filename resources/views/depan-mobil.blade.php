@extends('layouts.depan.main')
@section('content')

<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>Mobil</h2>
      <ol>
        <li><a href="{{ route('front') }}">Home</a></li>
        <li>Mobil</li>
      </ol>
    </div>

  </div>
</section><!-- End Breadcrumbs Section -->

<section class="inner-page">
  <div class="container">
    <!-- ======= Team Section ======= -->
    <section id="team">
      <div class="container" data-aos="fade-up">

        <div class="row">

          @foreach($mobil as $data)
            <div class="col-lg-3 col-md-6">
              <div class="member shadow-lg p-2 bg-body rounded" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('gambar/'.$data->gambar) }}" class="img-fluid" alt="">
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>{{ $data->tipe }}</h4>
                    <div class="social">
                      <a href="{{ route('front.mobil.detail', $data->id) }}" class="btn btn-success">Lihat Harga</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        </div>

      </div>
    </section><!-- End Team Section -->
  </div>
</section>

@endsection