@extends('template')
@section('title','Pola Kerja Kelompok Karyawan')
@section('content')

    @include('validation')

    @include('alert')

   

    <div class="row">
        <div class="col-md-5">
            {{ Form::open(['url'=>'simpan-pola-kerja-kelompok-karyawan'])}}
            {{ Form::hidden('kelompok_kerja_id',$kelompokKerja->id)}}
            <table class="table table-bordered">
                <tr>
                    <td>Nama Kelompok</td>
                <td>  : {{ $kelompokKerja->kelompok_kerja}}</td>
                </tr>

                <tr>
                    <td>Dari Tanggal</td>
                    <td>{{ Form::date('dari_tanggal',null,['class'=>'form-control','placeholder'=>'Dari tanggal'])}}</td>
                </tr>
                <tr>
                    <td>Sampai Tanggal</td>
                    <td>{{ Form::date('sampai_tanggal',null,['class'=>'form-control','placeholder'=>'Sampai tanggal'])}}</td>
                </tr>
                <tr>
                        <td>Pola Kerja</td>
                        <td>{{ Form::select('pola_kerja',$polaKerja,null,['class'=>'form-control'])}}</td>
                </tr>
                <tr>
                            <td></td>
                            <td><button type="submit" class="btn btn-warning">Simpan</button></td>
                        </tr>
            </table>
            {{ Form::close()}}
        </div>
        <div class="col-md-7">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <th>Pola Kerja</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Delete</th>
                </tr>
                @foreach($polakerjaKelompok as $row)
                <tr>
                    <td>{{ date('l', strtotime($row->tanggal)) }},  {{ date_format(date_create($row->tanggal),"d-m-Y")  }}</td>
                    <td>{{ $row->pola_kerja }}</td>
                    <td>{{ $row->jam_masuk }}</td>
                    <td>{{ $row->jam_pulang }}</td>
                    <td>
                        {{ Form::open(['url'=>'hapus-pola-kerja-kelompok-karyawan/'.$row->id,'method'=>'delete'])}}
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        {{ Form::close()}}
                    </td>
                </tr>
                @endforeach
            </table>

            {{ $polakerjaKelompok->links()}}
        </div>
    </div>
@endsection