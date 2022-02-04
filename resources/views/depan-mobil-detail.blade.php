@extends('layouts.depan.main')
@section('content')

<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>Harga Mobil {{ $mobil->tipe }}</h2>
      <ol>
        <li><a href="{{ route('front') }}">Home</a></li>
        <li><a href="{{ route('front.mobil') }}">Mobil</a></li>
        <li>Mobil Detail</li>
      </ol>
    </div>

  </div>
</section><!-- End Breadcrumbs Section -->

<section class="inner-page">
  <div class="container">

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-12 entries">

            <article class="entry entry-single">

              <div class="text-center">
                <img src="{{ asset('gambar/'.$mobil->gambar) }}" width="600px" alt="" class="img-fluid">
              </div>
              
              <br>

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

            </article><!-- End blog entry -->

          </div><!-- End blog entries list -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->
  </div>
</section>

@endsection