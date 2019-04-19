@extends('template')
@section('title','Komponen Gaji Untuk '.$kelompokGaji->nama_kelompok_gaji)
@section('content')

    @include('validation')
    @include('alert')

    <div class="row">
        <div class="col-md-5">
            {{ Form::model($kelompokGaji,['url'=>'kelompokgaji/'.$kelompokGaji->kode_kelompok_gaji,'method'=>'PUT'])}}
            @include('kelompokgaji.form')
            {{ Form::close()}}

            <h4>Input Komponen Gaji</h4>
            <hr>
            {{ Form::open(['url'=>'tambah-komponen-gaji'])}}
            {{ Form::hidden('kode_kelompok_gaji',$kelompokGaji->kode_kelompok_gaji)}}
            <table class="table table-bordered">
                <tr>
                    <td>Komponen</td>
                <td>{{ Form::select('kode_komponen_gaji',$komponenGaji,null,['class'=>'form-control'])}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-danger">Tambahkan</button></td>
                </tr>
            </table>
            {{ Form::close()}}
        </div>
        <div class="col-md-7">
            <table class="table table-bordered" id="example1">
                    <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Kelompok Gaji</th>
                    <th>Penghitung</th>
                    <th>Nilai Default</th>
                    <th width="10"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($komponen as $kom)
                <tr>
                    <td>{{ $kom->kode_komponen}}</td>
                    <td>{{ $kom->nama_komponen}}</td>
                    <td>Bulanan</td>
                    <td>{{ $kom->nilai}}</td>
                    <td>
                        {{ Form::open(['url'=>'hapus-komponen-gaji/'.$kom->id,'method'=>'delete'])}}
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        {{ Form::close()}}
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
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