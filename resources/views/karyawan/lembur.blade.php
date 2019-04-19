@extends('template')
@section('title','Riwayat Lembur Karyawan')
@section('content')

    @include('validation')

    @include('alert')

    @include('karyawan.tab')

    <div class="row">
        <div class="col-md-3">
            <table class="table table-bordered">
                <tr>
                    <td><img src="{{ asset('uploads/'.$karyawan->foto)}}" width="220"></td>
                </tr>
                <tr>
                    <td>{{ $karyawan->nama}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-9">

            @include('karyawan.filter')
                       
            <table class="table table-bordered">
                <tr>
                    
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Pulang</th>
                    <th>Durasi Lembur</th>
                    <th>Hapus</th>
                </tr>
                @foreach($riwayatKehadiran as $row)
                <tr>
                    <td>{{ $row->tanggal_masuk}} </td>
                    <td>{{ $row->tanggal_pulang}} </td>
                    <td>{{ $row->durasi_lembur}} </td>
                    <td>
                        {{ Form::open(['url'=>'hapus-riwayat-lembur/'.$row->id.'/karyawan','method'=>'delete'])}}
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        {{ Form::close()}}
                    </td>
                </tr>
                @endforeach
            </table>

            {{  $riwayatKehadiran->links()}}
        </div>
    </div>

@endsection