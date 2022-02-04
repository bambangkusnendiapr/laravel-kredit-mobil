@section('mobil', 'active')
@section('title', 'Edit Mobil')

<x-admin-layout>
  <div>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Mobil</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{ route('mobils.index') }}">Mobil</a></li>
                <li class="breadcrumb-item active">Edit Mobil</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
    
      <!-- Main content -->
      <section class="content">        
        <div class="container-fluid">
         <div class="row">
           <div class="col-8">
            <div class="card">
                <div class="card-header">
                  <a href="{{ route('mobils.index') }}" class="btn btn-dark">Kembali</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="{{ route('mobils.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')  
                    @csrf
                    <div class="form-group">
                      <label for="tipe">Tipe Mobil</label>
                      <input required name="tipe" type="text" class="form-control @error('tipe') is-invalid @enderror" id="tipe" placeholder="Tipe Mobil" value="{{ $mobil->tipe }}" autofocus>
                      @error('tipe')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="ket">Keterangan</label>
                      <textarea id="ket" name="ket" class="form-control @error('ket') is-invalid @enderror" placeholder="ket...">{{ $mobil->ket }}</textarea>
                      @error('ket')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group mt-5">
                      @if($mobil->gambar)
                        <img id="img" src="{{ url('gambar/'.$mobil->gambar)}}" width="100px"/>
                      @else
                        <img id="img" src="{{ url('img/mobil.png')}}" width="100px"/>
                      @endif
                    </div>
                    <div class="form-group"> 
                      <label><strong>Gambar Mobil</strong></label>@error('filefoto') <span class="text-danger font-italic">{{ $message }}</span>@enderror
                      <div class="custom-file mb-3">
                          <input type="file" name="filefoto" class="custom-file-input @error('filefoto') is-invalid @enderror" id="filefoto">
                          <label class="custom-file-label" for="filefoto">Pilih Gambar</label>
                          <div class="text-default">
                            Max: 2mb
                          </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-warning">Edit</button>
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
           </div>
         </div>
        </div>
      </section>
      <!-- /.content -->
  </div>



@push('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    bsCustomFileInput.init();

    $('#filefoto').change(function(){
      var input = this;
      var url = $(this).val();
      var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
      if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
      {
          var reader = new FileReader();

          reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
          }
        reader.readAsDataURL(input.files[0]);
      }
    })
  });
</script>
@endpush

</x-admin-layout>