@extends('template')
@section('title','Pola Kerja Karyawan')
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
                </tr>
                @foreach($polaKerjaKaryawan as $row)
                <tr>
                    <td>{{ date('l', strtotime($row->tanggal)) }},  {{ date_format(date_create($row->tanggal),"d-m-Y")  }} </td>
                    <td>{{ $row->pola_kerja}} </td>
                    <td>{{ $row->jam_masuk}} </td>
                    <td>{{ $row->jam_pulang}} </td>
                </tr>
                @endforeach
            </table>

            {{  $polaKerjaKaryawan->links()}}
        </div>
    </div>

@endsection