@extends('template')
@section('title','Riwayat Kehadiran Karyawan')
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
                    <th>Tanggal</th>
                    <th>Pola Kerja</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Absen Masuk</th>
                    <th>Absen Pulang</th>
                </tr>
                @foreach($riwayatKehadiran as $row)
                <tr>
                    <td>{{ date('l', strtotime($row->tanggal_masuk)) }},  {{ date_format(date_create($row->tanggal_masuk),"d-m-Y")  }} </td>
                    <td>{{ $row->pola_kerja}} </td>
                    <td>{{ $row->jam_masuk}} </td>
                    <td>{{ $row->jam_pulang}} </td>
                    <td>{{ $row->tanggal_masuk}} </td>
                    <td>{{ $row->tanggal_pulang}} </td>
                </tr>
                @endforeach
            </table>

            {{  $riwayatKehadiran->links()}}
        </div>
    </div>

@endsection