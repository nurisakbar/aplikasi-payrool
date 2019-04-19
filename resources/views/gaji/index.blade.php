@extends('template')
@section('title','Laporan Gaji karyawan')
@section('content')

    @include('validation')

    @include('alert')

    <div class="row">
        <div class="col-md-4">
            <h4>Filter Laporan</h4>
            {{ Form::open(['url'=>'ubah-periode-gaji'])}}
            <table class="table table-bordered">
                <tr>
                    <td width="150">Periode Laporan</td>
                    <td>
                        {{ Form::select('periode',$periodeGaji,null,['class'=>'form-control'])}}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-danger">Refresh</button></td>
                </tr>
            </table>
            {{ Form::close()}}

            <h4>Input Periode Gaji</h4>
            <hr>
            {{ Form::open(['url'=>'gaji'])}}
            <table class="table table-bordered">
                    <tr>
                        <td width="150">Periode Gaji</td>
                    <td>{{ Form::text('periode',null,['class'=>'form-control','placeholder'=>'Ex : 201904'])}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" class="btn btn-danger">Buat</button></td>
                    </tr>
                </table>
                {{ Form::close()}}
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Periode Gaji</th>
                    <th>Detail</th>
                    <th>Cetak</th>
                </tr>
                @foreach($riwayatGaji as $row)
                <tr>
                    <td>{{ $row->nik}}</td>
                    <td>{{ $row->nama}}</td>
                    <td>{{ $row->periode}}</td>
                    <td><a href="/gaji/{{ $row->id }}" class="btn btn-info">Detail</a></td>
                    <td><a href="/gaji/{{ $row->id}}/pdf" class="btn btn-danger">Cetak</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    

@endsection