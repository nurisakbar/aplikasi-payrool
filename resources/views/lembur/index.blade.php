@extends('template')
@section('title','Riwayat Lembur')
@section('content')

    <div class="row">
      <div class="col-md-5">
        {{ Form::open(['url'=>'ubah-periode-lembur'])}}
        <table class="table table-bordered">
          <tr>
            <td>Filter Laporan</td>
            <td>
              {{ Form::date('periode_lembur',null,['class'=>'form-control'])}}
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <button type="submit" class="btn btn-danger"><i class="fa fa-spinner" aria-hidden="true"></i>
                 Filter Laporan</button>
              <a href="lembur/create" class="btn btn-danger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Input Manual</a>
            </td>
          </tr>
        </table>
        {{ Form::close()}}
      </div>
      <div class="col-md-6">

      </div>
    </div>
    
    
    <hr>
    @include ('alert')

    <table class="table table-bordered" id="example1">
            <thead>
        <tr>
            <th width="100">NIK</th>
            <th>Nama Karyawan</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Pulang</th>
            <th>Durasi Lembur</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($riwayatLembur as $row)
        <tr>
            <td>{{ $row->nik}}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->tanggal_masuk }}</td>
            <td>{{ $row->tanggal_pulang }}</td>
            <td>{{ $row->durasi_lembur }}</td>
            <td>
                {{ Form::open(['url'=>'hapus-riwayat-lembur/'.$row->id.'/lembur','method'=>'delete'])}}
                <button type="submit" class="btn btn-danger">Hapus</button>
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