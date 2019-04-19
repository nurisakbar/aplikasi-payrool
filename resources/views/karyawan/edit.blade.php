@extends('template')
@section('title','Edit Data Karyawan')
@section('content')

    @include('validation')
    @include('karyawan.tab')

    {{ Form::model($karyawan,['url'=>'karyawan/'.$karyawan->nik,'method'=>'PUT','files'=>true])}}

    @include('karyawan.form')
    
    {{ Form::close()}}
@endsection