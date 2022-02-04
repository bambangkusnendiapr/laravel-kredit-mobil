@section('title', 'Data Pembelian')
@section('beli', 'active')
<div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Data Pembelian</h1>
          </div>
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Data Pembelian</li>
          </ol>
          </div>
      </div>
      </div><!-- /.container-fluid -->
  </section>
  
  <!-- Main content -->
  <section class="content">
      
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <button wire:click.prevent="addNew" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <select wire:model="paginate" class="form-control form-control-sm">
                              <option value="10">10 data per halaman</option>
                              <option value="15">15 data per halaman</option>
                              <option value="20">20 data per halaman</option>
                              <option value="30">30 data per halaman</option>
                              <option value="50">50 data per halaman</option>
                          </select>
                      </div>
                  </div>

                  <!-- <div class="col-md-4 offset-md-4">
                      <div class="form-group">
                          <div class="input-group input-group-sm">
                              <input wire:model="search" type="text" class="form-control form-control-sm" placeholder="Cari Nama Pembeli...">
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                              </div>
                          </div>
                      </div>
                  </div> -->
              </div>

                <div class="table-responsive">
                  <table class="table table-sm table-striped mt-1" width="100%">
                      <thead>
                          <tr class="text-center">
                              <th>#</th>
                              <th>Tanggal</th>
                              <th>Sales</th>
                              <th>Pembeli</th>
                              <th>Bank</th>
                              <th>Tipe Mobil</th>
                              <th>Harga</th>
                              <th>Tenor</th>
                              <th>Bunga</th>
                              <th>DP</th>
                              <th>DP Nominal</th>
                              <th>Angsuran</th>
                              <th>Keterangan</th>
                              <th>Kredit</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        @if($beli->isEmpty())
                          <tr>
                                  <td colspan="15" class="text-center font-italic text-danger"><h5>-- Data Tidak Ditemukan --</h5></td>
                          </tr>
                        @else
                          @foreach($beli as $key => $data)
                            <tr>
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $data->tanggal->format('d F Y') }}</td>
                              <td class="text-center">{{ $data->salesman->name }}</td>
                              <td class="text-center">{{ $data->buyer->nama }}</td>
                              @php $a = $bank->find($data->harga->bank_id); @endphp
                              <td class="text-center">{{ $a->nama }}</td>
                              @php $b = $mobil->find($data->harga->mobil_id); @endphp
                              <td class="text-center">{{ $b->tipe }}</td>
                              <td class="text-center">Rp. {{ number_format($data->harga->harga, 0) }}</td>
                              <td class="text-center">{{ $data->harga->tenor }}</td>
                              <td class="text-center">{{ $data->harga->bunga_persen }}</td>
                              <td class="text-center">{{ $data->harga->dp_persen }}</td>
                              <td class="text-center">Rp. {{ number_format($data->harga->dp_nominal, 0) }}</td>
                              <td class="text-center">Rp. {{ number_format($data->harga->angsuran, 0) }}</td>
                              <td class="text-center">{{ $data->ket }}</td>
                              <td class="text-right">
                                  <a href="{{ route('kredit', $data->id) }}" class="btn btn-success btn-sm">Bayar Kredit</a>
                              </td>
                              <td class="text-right">
                                  <button wire:click.prevent="edit({{ $data->id }})" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                  <button wire:click.prevent="delete({{ $data->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                  </table>
                </div>

              </div>
              <!-- /.card-body -->
              </div>
          <!-- /.card -->
          </div>
      </div>
      </div>
  </section>
  <!-- /.content -->

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="form" wire:ignore.self>
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Form Tambah Pembelian</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="createData">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-3 col-6">
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input wire:model.defer="state.tanggal" required type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tipe Mobil" autofocus>
                  @error('tanggal')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="form-group">
                  <label for="pembeli">pembeli</label>
                  <select wire:model.defer="state.pembeli" required id="pembeli" class="form-control @error('pembeli') is-invalid @enderror">
                    <option value="">--Pilih Pembeli--</option>
                    @foreach($buyer as $data)
                      <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                  </select>
                  @error('pembeli')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="form-group">
                  <label for="tipe">Tipe Mobil</label>
                  <select wire:model="tipe" required id="tipe" class="form-control @error('tipe') is-invalid @enderror">
                    <option value="">--Pilih Tipe Mobil--</option>
                    @foreach($mobil as $data)
                      <option value="{{ $data->id }}">{{ $data->tipe }}</option>
                    @endforeach
                  </select>
                  @error('tipe')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="form-group">
                  <label for="lembaga">Bank</label>
                  <select wire:model="lembaga" required id="lembaga" class="form-control @error('lembaga') is-invalid @enderror">
                    <option value="">--Pilih Bank--</option>
                    @foreach($bank as $data)
                      <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                  </select>
                  @error('lembaga')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="harga">Harga | Tenor | Bunga | DP % | DP Nominal | Angsuran</label>
                  <select wire:model="harga" required id="harga" class="form-control @error('harga') is-invalid @enderror">
                    <option value="" selected disabled>--Pilih Harga / Kredit--</option>
                    @if($harga)
                      @foreach($harga as $data)
                        <option value="{{ $data->id }}">Rp. {{ number_format($data->harga, 0) }} | {{ $data->tenor }} | {{ $data->bunga_persen }}% | {{ $data->dp_persen }}% | Rp. {{ number_format($data->dp_nominal, 0) }} | Rp. {{ number_format($data->angsuran, 0) }}</option>
                      @endforeach
                    @endif
                  </select>
                  @error('harga')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="sales">Sales</label>
                  <select wire:model.defer="state.sales" required id="sales" class="form-control @error('sales') is-invalid @enderror">
                    <option value="">--Pilih sales--</option>
                    @foreach($sales as $data)
                      <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                  </select>
                  @error('sales')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="ket">Keterangan</label>
              <textarea wire:model.defer="state.ket" required id="ket" class="form-control @error('ket') is-invalid @enderror" placeholder="ket..."></textarea>
              @error('ket')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal Edit Data -->
  <div class="modal fade" id="modal-edit" wire:ignore.self>
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h4 class="modal-title">Form Edit Pembelian</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="updateData">
        <div class="modal-body">
            <div class="row">
              <div class="col-md-3 col-6">
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input wire:model.defer="state.tanggal" required type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tipe Mobil" autofocus>
                  @error('tanggal')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="form-group">
                  <label for="pembeli">pembeli</label>
                  <select wire:model.defer="state.pembeli" required id="pembeli" class="form-control @error('pembeli') is-invalid @enderror">
                    <option value="">--Pilih Pembeli--</option>
                    @foreach($buyer as $data)
                      <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                  </select>
                  @error('pembeli')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="form-group">
                  <label for="tipe">Tipe Mobil</label>
                  <select wire:model="tipe" required id="tipe" class="form-control @error('tipe') is-invalid @enderror">
                    <option value="">--Pilih Tipe Mobil--</option>
                    @foreach($mobil as $data)
                      <option value="{{ $data->id }}">{{ $data->tipe }}</option>
                    @endforeach
                  </select>
                  @error('tipe')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="form-group">
                  <label for="lembaga">Bank</label>
                  <select wire:model="lembaga" required id="lembaga" class="form-control @error('lembaga') is-invalid @enderror">
                    <option value="">--Pilih Bank--</option>
                    @foreach($bank as $data)
                      <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                  </select>
                  @error('lembaga')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="harga">Harga | Tenor | Bunga | DP % | DP Nominal | Angsuran</label>
                  <select wire:model="harga" required id="harga" class="form-control @error('harga') is-invalid @enderror">
                    <option value="" selected disabled>--Pilih Harga / Kredit--</option>
                    @if($harga)
                      @foreach($harga as $data)
                        <option value="{{ $data->id }}">Rp. {{ number_format($data->harga, 0) }} | {{ $data->tenor }} | {{ $data->bunga_persen }}% | {{ $data->dp_persen }}% | Rp. {{ number_format($data->dp_nominal, 0) }} | Rp. {{ number_format($data->angsuran, 0) }}</option>
                      @endforeach
                    @endif
                  </select>
                  @error('harga')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="sales">Sales</label>
                  <select wire:model.defer="state.sales" required id="sales" class="form-control @error('sales') is-invalid @enderror">
                    <option value="">--Pilih sales--</option>
                    @foreach($sales as $data)
                      <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                  </select>
                  @error('sales')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="ket">Keterangan</label>
              <textarea wire:model.defer="state.ket" required id="ket" class="form-control @error('ket') is-invalid @enderror" placeholder="ket..."></textarea>
              @error('ket')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Edit</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal Delete Data -->
  <div class="modal fade" id="modal-delete" wire:ignore.self>
      <div class="modal-dialog">
          <div class="modal-content bg-danger">
          <div class="modal-header">
              <h4 class="modal-title">Hapus Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
              <div class="modal-body">
                  <h5>Yakin ingin hapus data ?</h5>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                  <button wire:click.prevent="deleteData" type="button" class="btn btn-outline-light">Lanjut Hapus</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
  <!-- /.modal-dialog -->
  </div>

  @push('style')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  @endpush


  @push('script')
  <!-- SweetAlert2 -->
  <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- Sweet alert real rashid -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script>
    $(function () {
      $( "#nett, #sales" ).change(function() {
        let nett = $( "#nett" ).val();
        let sales = $( "#sales" ).val();
        let list = parseInt(nett.replaceAll('.', '')) + parseInt(sales.replaceAll('.', ''));
        $( "#list" ).val(list);
        $( "#hadiah, #ket" ).keyup(function() {
          $('.uang_list').mask('000.000.000.000', {reverse: true});
        });
        $('.uang').mask('000.000.000.000', {reverse: true});
      });

      $( "#nettEdit, #salesEdit" ).change(function() {
        let nett = $( "#nettEdit" ).val();
        let sales = $( "#salesEdit" ).val();
        let list = parseInt(nett.replaceAll('.', '')) + parseInt(sales.replaceAll('.', ''));
        $( "#listEdit" ).val(list);
        $( "#hadiah, #ket" ).keyup(function() {
          $('.uang_list').mask('000.000.000.000', {reverse: true});
        });
        $('.uang').mask('000.000.000.000', {reverse: true});
      });

      window.addEventListener('show-form-delete', event => {
          $('#modal-delete').modal('show');
      });

      window.addEventListener('hide-form-delete', event => {
          $('#modal-delete').modal('hide');

          Swal.fire({
              "title":"Sukses!",
              "text":"Data Berhasil Dihapus",
              "position":"middle-center",
              "timer":2000,
              "width":"32rem",
              "heightAuto":true,
              "padding":"1.25rem",
              "showConfirmButton":false,
              "showCloseButton":false,
              "icon":"success"
          });

      });

      window.addEventListener('show-form-edit', event => {
          $('#modal-edit').modal('show');
          // alert('edit');
      });

      window.addEventListener('hide-form-edit', event => {
          $('#modal-edit').modal('hide');

          Swal.fire({
              "title":"Sukses!",
              "text":"Data Berhasil Diedit",
              "position":"middle-center",
              "timer":2000,
              "width":"32rem",
              "heightAuto":true,
              "padding":"1.25rem",
              "showConfirmButton":false,
              "showCloseButton":false,
              "icon":"success"
          });

      });

      window.addEventListener('show-form', event => {
          $('#form').modal('show');
      });

      window.addEventListener('hide-form', event => {
        $('#form').modal('hide');

        Swal.fire({
            "title":"Sukses!",
            "text":"Data Berhasil Ditambahkan",
            "position":"middle-center",
            "timer":2000,
            "width":"32rem",
            "heightAuto":true,
            "padding":"1.25rem",
            "showConfirmButton":false,
            "showCloseButton":false,
            "icon":"success"
        });

    });

    });
  </script>
  
  @endpush


</div>