@section('title', 'Data Harga')
@section('bank', 'active')
<div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Data Harga {{ $bank->nama }}</h1>
          </div>
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item"><a href="{{ route('bank') }}">Bank</a></li>
              <li class="breadcrumb-item active">Data Harga</li>
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
            @role('superadmin')
              <div class="card-header">
                  <button wire:click.prevent="addNew" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button>
              </div>
            @endrole
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
                </div>

                <div class="table-responsive-sm">
                  <table class="table table-sm table-striped mt-1">
                      <thead>
                          <tr class="text-center">
                              <th>#</th>
                              <th>Tipe Mobil</th>
                              <th>Harga</th>
                              <th>Tenor</th>
                              <th>Bunga %</th>
                              <th>DP %</th>
                              <th>TDP Nominal</th>
                              <th>Angsuran</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if($harga->isEmpty())
                              <tr>
                                      <td colspan="9" class="text-center font-italic text-danger"><h5>-- Data Tidak Ditemukan --</h5></td>
                              </tr>
                          @else
                              @foreach($harga as $key => $data)
                                  <tr>
                                      <td class="text-center">{{ $harga->firstItem() + $key }}</td>
                                      @php $tipe = $mobil->find($data->mobil_id); @endphp
                                      <td class="text-center">{{ $tipe->tipe }}</td>
                                      <td class="text-center">{{ number_format($data->harga, 0) }}</td>
                                      <td class="text-center">{{ $data->tenor }}</td>
                                      <td class="text-center">{{ $data->bunga_persen }}</td>
                                      <td class="text-center">{{ $data->dp_persen }}</td>
                                      <td class="text-center">{{ number_format($data->dp_nominal, 0) }}</td>
                                      <td class="text-center">{{ number_format($data->angsuran, 0) }}</td>
                                      <td class="text-right">
                                        @role('superadmin')
                                          <button wire:click.prevent="edit({{ $data->id }})" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                          <button wire:click.prevent="delete({{ $data->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        @endrole
                                      </td>
                                  </tr>
                              @endforeach
                          @endif
                      </tbody>
                  </table>
                </div>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $harga->links() }}
                    </ul>
                </nav>

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
          <h4 class="modal-title">Form Tambah Data Kredit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="createData">
          <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Mobil</label>
                  <div class="col-sm-10">
                    <select wire:model.defer="state.mobil" required class="form-control @error('mobil') is-invalid @enderror">
                      <option value="">--Pilih Tipe Mobil--</option>
                      @foreach($mobil as $data)
                        <option value="{{ $data->id }}">{{ $data->tipe }}</option>
                      @endforeach
                    </select>
                    @error('mobil')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                  <div class="col-sm-10">
                    <input wire:model.defer="state.harga" required type="text" class="form-control @error('harga') is-invalid @enderror uang" id="harga" placeholder="Cth: 1000000">
                    @error('harga')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="tenor">Tenor / Bulan</label>
                  <input wire:model.defer="state.tenor" required type="number" class="form-control @error('tenor') is-invalid @enderror" id="tenor">
                  @error('tenor')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label for="bunga">Bunga</label>
                  <input wire:model.defer="state.bunga" required type="text" class="form-control @error('bunga') is-invalid @enderror" id="bunga">
                  @error('bunga')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label for="dp">DP %</label>
                  <input wire:model.defer="state.dp" required type="number" class="form-control @error('dp') is-invalid @enderror" id="dp">
                  @error('dp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="tdp">TDP Nominal</label>
                  <input wire:model.defer="state.tdp" required type="text" class="form-control @error('tdp') is-invalid @enderror uang" id="tdp">
                  @error('tdp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="angsuran">Angsuran</label>
                  <input wire:model.defer="state.angsuran" required type="text" class="form-control @error('angsuran') is-invalid @enderror uang" id="angsuran">
                  @error('angsuran')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
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
          <h4 class="modal-title">Form Edit Data Jenis Pelanggaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="updateData">
        <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Mobil</label>
                  <div class="col-sm-10">
                    <select wire:model.defer="state.mobil" required class="form-control @error('mobil') is-invalid @enderror">
                      <option value="">--Pilih Tipe Mobil--</option>
                      @foreach($mobil as $data)
                        <option value="{{ $data->id }}">{{ $data->tipe }}</option>
                      @endforeach
                    </select>
                    @error('mobil')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                  <div class="col-sm-10">
                    <input wire:model.defer="state.harga" required type="text" class="form-control @error('harga') is-invalid @enderror uang" id="harga" placeholder="Cth: 1000000">
                    @error('harga')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="tenor">Tenor / Bulan</label>
                  <input wire:model.defer="state.tenor" required type="number" class="form-control @error('tenor') is-invalid @enderror" id="tenor">
                  @error('tenor')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label for="bunga">Bunga</label>
                  <input wire:model.defer="state.bunga" required type="text" class="form-control @error('bunga') is-invalid @enderror" id="bunga">
                  @error('bunga')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label for="dp">DP %</label>
                  <input wire:model.defer="state.dp" required type="number" class="form-control @error('dp') is-invalid @enderror" id="dp">
                  @error('dp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="tdp">TDP Nominal</label>
                  <input wire:model.defer="state.tdp" required type="text" class="form-control @error('tdp') is-invalid @enderror uang" id="tdp">
                  @error('tdp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="angsuran">Angsuran</label>
                  <input wire:model.defer="state.angsuran" required type="text" class="form-control @error('angsuran') is-invalid @enderror uang" id="angsuran">
                  @error('angsuran')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
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

      $('.uang').mask('000.000.000.000', {reverse: true});

      $( "#nominal" ).keyup(function() {
        let nett = $( "#nett" ).val();
        let sales = $( "#sales" ).val();
        let list = parseInt(nett.replaceAll('.', '')) + parseInt(sales.replaceAll('.', ''));
        $( "#list" ).val(list);
        $( "#hadiah, #ket" ).keyup(function() {
          $('.uang_list').mask('000.000.000.000', {reverse: true});
        });
        $('.uangg').mask('000.000.000.000', {reverse: true});
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