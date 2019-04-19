@extends('template')
@section('title','Data Pola Kerja')
@section('content')

    @include ('alert')
    
    <a href="polakerja/create" class="btn btn-danger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah Data</a>
    <hr>
    <table class="table table-bordered" id="example1">
            <thead>
        <tr>
            <th>Nama polakerja</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($polaKerja as $row)
        <tr>
            <td>{{ $row->pola_kerja }}</td>
            <td>{{ $row->jam_masuk }}</td>
            <td>{{ $row->jam_pulang }}</td>
            <td width="50"><a href="/polakerja/{{ $row->id}}/edit" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                 Edit</a></td>
            <td width="50">
                {{ Form::open(['url'=>'polakerja/'.$row->id,'method'=>'delete'])}}
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
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

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