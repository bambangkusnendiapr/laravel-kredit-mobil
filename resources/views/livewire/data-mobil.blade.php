@section('title', 'Data Mobil')
@section('mobil', 'active')
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
                              <th>Gambar</th>
                              <th>Tipe</th>
                              <th>Keterangan</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if($mobil->isEmpty())
                              <tr>
                                      <td colspan="10" class="text-center font-italic text-danger"><h5>-- Data Tidak Ditemukan --</h5></td>
                              </tr>
                          @else
                              @foreach($mobil as $key => $data)
                                  <tr>
                                      <td class="text-center">{{ $mobil->firstItem() + $key }}</td>
                                      <td class="text-center">
                                          <img src="{{ $data->gambar_url }}" class="img img-fluid mr-2" width="50px" alt="">
                                      </td>
                                      <td class="text-center">
                                        {{ $data->tipe }}
                                      </td>
                                      <td class="text-center">{{ $data->ket }}</td>
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
                        {{ $mobil->links() }}
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
        <form wire:submit.prevent="createData">
          <div class="modal-body">
            <div class="form-group">
              <label for="tipe">Tipe Mobil</label>
              <input wire:model.defer="state.tipe" required type="text" class="form-control @error('tipe') is-invalid @enderror" id="tipe" placeholder="Tipe Mobil" autofocus>
              @error('tipe')
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
            <div class="form-group">
              <label for="exampleInputFile">Gambar Mobil @error('photo')<span class="text-danger">{{ $message }}</span>@enderror</label>
              @if ($photo)
                  <img src="{{ $photo->temporaryUrl() }}" class="img img-fluid d-block mb-2" width="50px">
              @endif
              <div class="input-group">
                <div class="custom-file">
                  <input wire:model="photo" type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">
                    @if($photo)
                      {{ $photo->getClientOriginalName() }}
                    @else
                      Pilih Gambar
                    @endif
                  </label>
                </div>
              </div>
              <span>Maksimal 2MB</span>
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
          <h4 class="modal-title">Form Edit Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="updateData">
          <div class="modal-body">
            <div class="form-group">
                <label for="tipe">Tipe Mobil</label>
                <input wire:model.defer="state.tipe" required type="text" class="form-control @error('tipe') is-invalid @enderror" id="tipe" placeholder="Tipe Mobil" autofocus>
                @error('tipe')
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
              <div class="form-group">
                <label for="exampleInputFile">Gambar Mobil (Kosongkan jika tidak ganti gambar) @error('photo')<span class="text-danger">{{ $message }}</span>@enderror</label>
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" class="img img-fluid d-block mb-2" width="50px">
                @endif
                <div class="input-group">
                  <div class="custom-file">
                    <input wire:model="photo" type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">
                      @if($photo)
                        {{ $photo->getClientOriginalName() }}
                      @else
                        Pilih Gambar
                      @endif
                    </label>
                  </div>
                </div>
                <span>Maksimal 2MB</span>
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