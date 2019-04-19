@extends('template')
@section('title','Edit Data Kelompok Kerja')
@section('content')

@include('karyawan.tab')

    @include('validation')

    {{ Form::model($kelompokKerja,['url'=>'kelompokkerja/'.$kelompokKerja->id,'method'=>'PUT'])}}

    @include('kelompokkerja.form')
    
    {{ Form::close()}}
@endsection