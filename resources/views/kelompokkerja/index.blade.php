@extends('template')
@section('title','Data Kelompok Kerja')
@section('content')

    @include ('alert')
    
    <a href="kelompokkerja/create" class="btn btn-danger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah Data</a>
    <hr>
    <table class="table table-bordered" id="example1">
            <thead>
        <tr>
            <th>Nama kelompokkerja</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($kelompokKerja as $row)
        <tr>
            <td>{{ $row->kelompok_kerja }}</td>
            <td width="50"><a href="/kelompokkerja/{{ $row->id}}/polakerja" class="btn btn-success btn-sm"><i class="fa fa-calendar" aria-hidden="true"></i>
                Pola Kerja</a></td>
            <td width="50"><a href="/kelompokkerja/{{ $row->id}}" class="btn btn-success btn-sm"><i class="fa fa-users" aria-hidden="true"></i>
                Anggota</a></td>
            <td width="50"><a href="/kelompokkerja/{{ $row->id}}/edit" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                 Edit</a></td>
            <td width="50">
                {{ Form::open(['url'=>'kelompokkerja/'.$row->id,'method'=>'delete'])}}
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