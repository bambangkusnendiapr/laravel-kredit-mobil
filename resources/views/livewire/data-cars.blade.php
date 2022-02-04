@section('title', 'Data Mobil')
@section('car', 'active')
<div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Data Mobil</h1>
          </div>
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Data Mobil</li>
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

                  <div class="col-md-4 offset-md-4">
                      <div class="form-group">
                          <div class="input-group input-group-sm">
                              <input wire:model="search" type="text" class="form-control form-control-sm" placeholder="Cari Tipe...">
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                              </div>
                          </div>
                          <!-- <input  type="text" class="form-control form-control-sm w-100" placeholder="Cari Nama"> -->
                      </div>
                  </div>
              </div>

                <div class="table-responsive-sm">
                  <table class="table table-sm table-striped mt-1">
                      <thead>
                          <tr class="text-center">
                              <th>#</th>
                              <th>Tipe</th>
                              <th>Price List</th>
                              <th>Price Sales</th>
                              <th>Price Nett</th>
                              <th>DP</th>
                              <th>Hadiah</th>
                              <th>Kredit</th>
                              <th>Keterangan</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if($cars->isEmpty())
                              <tr>
                                      <td colspan="10" class="text-center font-italic text-danger"><h5>-- Data Tidak Ditemukan --</h5></td>
                              </tr>
                          @else
                              @foreach($cars as $key => $data)
                                  <tr>
                                      <td class="text-center">{{ $cars->firstItem() + $key }}</td>
                                      <td class="text-center">{{ $data->type }}</td>
                                      <td class="text-center">{{ number_format(($data->price_sales+$data->price_nett), 0) }}</td>
                                      <td class="text-center">{{ number_format($data->price_sales, 0) }}</td>
                                      <td class="text-center">{{ number_format($data->price_nett, 0) }}</td>
                                      <td class="text-center">{{ number_format(($data->price_nett + $data->price_sales)/4, 0) }}</td>
                                      <td class="text-center">{{ $data->hadiah }}</td>
                                      <td class="text-center">
                                        12 bln / 1 thn = {{ number_format((($data->price_nett + $data->price_sales) - (($data->price_nett + $data->price_sales)/4)) / 12, 0) }}
                                        <br>
                                        24 bln / 2 thn = {{ number_format((($data->price_nett + $data->price_sales) - (($data->price_nett + $data->price_sales)/4)) / 24, 0) }}
                                        <br>
                                        36 bln / 3 thn = {{ number_format((($data->price_nett + $data->price_sales) - (($data->price_nett + $data->price_sales)/4)) / 36, 0) }}
                                        <br>
                                        48 bln / 4 thn = {{ number_format((($data->price_nett + $data->price_sales) - (($data->price_nett + $data->price_sales)/4)) / 48, 0) }}
                                        <br>
                                        60 bln / 5 thn = {{ number_format((($data->price_nett + $data->price_sales) - (($data->price_nett + $data->price_sales)/4)) / 60, 0) }}
                                        
                                      </td>
                                      <td class="text-center">{{ $data->ket }}</td>
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

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $cars->links() }}
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Form Tambah Data Mobil</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="createCar">
          <div class="modal-body">
            <div class="form-group">
              <label for="type">Tipe Mobil</label>
              <input wire:model.defer="state.type" required type="text" class="form-control @error('type') is-invalid @enderror" id="type" placeholder="Tipe Mobil" autofocus>
              @error('type')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="nett">Price Nett</label>
              <input wire:model.defer="state.nett" required type="text" class="form-control @error('nett') is-invalid @enderror uang" id="nett" autocomplete="off">
              @error('nett')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="sales">Price Sales</label>
              <input wire:model.defer="state.sales" required type="text" class="form-control @error('sales') is-invalid @enderror uang" id="sales" autocomplete="off">
              @error('sales')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="list">Price List</label>
              <input wire:model.defer="state.list" type="text"disabled class="form-control @error('list') is-invalid @enderror uang_list" id="list">
              @error('list')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="hadiah">Hadiah</label>
              <textarea wire:model.defer="state.hadiah" required id="hadiah" class="form-control @error('hadiah') is-invalid @enderror" placeholder="Hadiah..."></textarea>
              @error('hadiah')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h4 class="modal-title">Form Edit Data Jenis Pelanggaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="updateCar">
          <div class="modal-body">
              <div class="form-group">
                <label for="type">Tipe Mobil</label>
                <input wire:model.defer="state.type" required type="text" class="form-control @error('type') is-invalid @enderror" id="type" placeholder="Tipe Mobil" autofocus>
                @error('type')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="nett">Price Nett</label>
                <input wire:model.defer="state.nett" required type="text" class="form-control @error('nett') is-invalid @enderror uang" id="nettEdit" autocomplete="off">
                @error('nett')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="sales">Price Sales</label>
                <input wire:model.defer="state.sales" required type="text" class="form-control @error('sales') is-invalid @enderror uang" id="salesEdit" autocomplete="off">
                @error('sales')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="list">Price List</label>
                <input wire:model.defer="state.list" type="text"disabled class="form-control @error('list') is-invalid @enderror uang_list" id="listEdit">
                @error('list')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="hadiah">Hadiah</label>
                <textarea wire:model.defer="state.hadiah" required id="hadiah" class="form-control @error('hadiah') is-invalid @enderror" placeholder="Hadiah..."></textarea>
                @error('hadiah')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
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
              <h4 class="modal-title">Hapus Data Pelanggaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
              <div class="modal-body">
                  <h5>Yakin ingin hapus data ?</h5>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                  <button wire:click.prevent="deleteCar" type="button" class="btn btn-outline-light">Lanjut Hapus</button>
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