@extends('template')
@section('title','Data Jabatan')
@section('content')

    @include ('alert')
    
    <a href="jabatan/create" class="btn btn-danger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah Data</a>
    <hr>
    <table class="table table-bordered" id="example1">
            <thead>
        <tr>
            <th width="100">Kode Jabatan</th>
            <th>Nama Jabatan</th>
            <th WIDTH="120">Tunjangan Jabatan</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($jabatan as $row)
        <tr>
            <td>{{ $row->kode_jabatan}}</td>
            <td>{{ $row->nama_jabatan }}</td>
            <td>{{ $row->tunjangan_jabatan }}</td>
            <td width="50"><a href="/jabatan/{{ $row->kode_jabatan}}/edit" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                 Edit</a></td>
            <td width="50">
                {{ Form::open(['url'=>'jabatan/'.$row->kode_jabatan,'method'=>'delete'])}}
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