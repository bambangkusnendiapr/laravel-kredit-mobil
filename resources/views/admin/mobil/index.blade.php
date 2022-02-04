@section('mobil', 'active')
@section('title', 'Mobil')

<x-admin-layout>
  <div>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mobil</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Mobil</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
    
      <!-- Main content -->
      <section class="content">        
        <div class="container-fluid">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
         <div class="row">
           <div class="col-12">
            <div class="card">
              @role('superadmin')
                <div class="card-header">
                  <a href="{{ route('mobils.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                </div>
              @endrole
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Gambar</th>
                      <th>Tipe</th>
                      <th>Ket</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($mobil as $data)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>
                            @if($data->gambar)
                              <img src="{{ asset('gambar/'.$data->gambar) }}" class="img img-fluid mr-2" width="50px" alt="">
                            @else
                              <img src="{{ asset('img/mobil.png') }}" class="img img-fluid mr-2" width="50px" alt="">
                            @endif
                          </td>
                          <td>{{ $data->tipe }}</td>
                          <td>{{ $data->ket }}</td>
                          <td>
                            <form action="{{ route('mobils.destroy', $data->id) }}" method="post">
                              @method('delete')
                              @csrf
                              <div class="btn-group">
                                <a href="{{ route('mobils.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                                <button type="submit" onclick="return confirm('Yakin ingin dihapus ?')" class="btn btn-danger">Hapus</button>
                              </div>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush

</x-admin-layout>