@extends('template')
@section('title','Riwayat Kehadiran')
@section('content')

    

    <div class="row">
      <div class="col-md-6">
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
              <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Export Data</button>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#import">Import</button>
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
            <th>Departemen</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Pulang</th>
            <th>Status Kehadiran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kehadiran as $row)
        <tr>
            <td>{{ $row->nik}}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->nama_departemen }}</td>
            <td>{{ $row->tanggal_masuk }}</td>
            <td>{{ $row->tanggal_pulang }}</td>
            <td>{{ $row->status_kehadiran }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>


    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Export laporan Kehadiran</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['url'=>'export-laporan-kehadiran-excel'])}}
        <table class="table table-bordered">
          <tr>
            <td>Dari Tanggal</td>
          <td>{{  Form::date('tanggal_mulai',null,['class'=>'form-control','placeholder'=>'Dari Mulai'])}}</td>
          </tr>
          <tr>
            <td>Sampai Tanggal</td>
            <td>{{  Form::date('tanggal_selesai',null,['class'=>'form-control','placeholder'=>'Tanggal Selesai'])}}</td>
          </tr>
          <tr>
            <td></td>
            <td>
              <button type="submit" class="btn btn-info">Export Data</button>
            </td>
          </tr>
        </table>
        {{ Form::close()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Modal -->
<div id="import" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Import Data Kehadiran</h4>
        </div>
        <div class="modal-body">
          {{ Form::open(['url'=>'upload-excel-kehadiran','files'=>true])}}
          <table class="table table-bordered">
            <tr><td>Pilih File</td><td>{{ Form::file('file')}}</td></tr>
            <tr><td></td><td><button type="submit">Upload File Excel</button></td></tr>
          </table>
          {{ Form::close()}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  
    </div>
  </div>


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