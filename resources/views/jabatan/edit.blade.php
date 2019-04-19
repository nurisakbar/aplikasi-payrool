@extends('template')
@section('title','Edit Data Jabatan')
@section('content')

    @include('validation')

    {{ Form::model($jabatan,['url'=>'jabatan/'.$jabatan->kode_jabatan,'method'=>'PUT'])}}

    @include('jabatan.form')
    
    {{ Form::close()}}
@endsection