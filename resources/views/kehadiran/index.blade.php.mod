@extends('template')
@section('title','Riwayat Kehadiran')
@section('content')

    

    <div class="row">
      <div class="col-md-5">
        {{ Form::open(['url'=>'ubah-periode-kehadiran'])}}
        <table class="table table-bordered">
          <tr>
            <td>Filter Laporan</td>
            <td>
              {{ Form::date('periode_kehadiran',null,['class'=>'form-control'])}}
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <button type="submit" class="btn btn-danger"><i class="fa fa-spinner" aria-hidden="true"></i>
                 Filter Laporan</button>
              <a href="kehadiran/create" class="btn btn-danger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Input Manual</a>
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
            <th width="300">Data Karyawan</th>
            {{-- <th>Nama Karyawan</th> --}}
            <th>Pola Kerja Karyawan</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Pulang</th>
            <th>Status Kehadiran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kehadiran as $row)
        <tr>
            <td>
            <table class="table table-bordered">
                <tr class="align center">
                    <td><img src="https://user.gadjian.com/static/images/t_personnel_girl.png" width="60"><hr>{{ $row->nik}}</td>
                    <td>{{ $row->nama }} <hr>{{ $row->nama_departemen }}</td>
                </tr>
            </table>
            </td>
            {{-- <td>{{ $row->nama }}</td> --}}
            <td>Pola Kerja Normal<hr>08:00 - 15:00</td>
            <td>{{ $row->tanggal_masuk }}</td>
            <td>{{ $row->tanggal_pulang }}</td>
            <td>{{ $row->status_kehadiran }}</td>
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