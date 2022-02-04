@extends('layouts.front.main')

@section('content')

  <section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">
      <div class="row">
        @foreach($mobil as $data)
        <div class="col-lg-4 col-md-6">
          <div class="member" data-aos="fade-up" data-aos-delay="100">
            <div class="pic"><img src="{{ asset('gambar/'.$data->gambar) }}" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>{{ $data->tipe }}</h4>
              <a href="{{ route('front.mobil.detail', $data->id) }}" class="btn btn-primary">Lihat Harga</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection