@extends('template')
@section('title','Data Departemen')
@section('content')

    @include ('alert')
    
    <a href="departemen/create" class="btn btn-danger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah Data</a>
    <hr>
    <table class="table table-bordered" id="example1">
            <thead>
        <tr>
            <th width="200">Kode Departemen</th>
            <th>Nama Departemen</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($departemen as $row)
        <tr>
            <td>{{ $row->kode_departemen}}</td>
            <td>{{ $row->nama_departemen }}</td>
            <td width="50"><a href="/departemen/{{ $row->kode_departemen}}/edit" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                 Edit</a></td>
            <td width="50">
                {{ Form::open(['url'=>'departemen/'.$row->kode_departemen,'method'=>'delete'])}}
                 <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                     Hapus</button>
                {{ Form::close()}}
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
@endsection
@push('scipts')
<!-- DataTables -->
<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- page script -->
<script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })
      </script>
@endpush