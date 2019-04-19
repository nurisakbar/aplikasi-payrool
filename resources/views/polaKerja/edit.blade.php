@extends('template')
@section('title','Edit Data Pola Kerja')
@section('content')

    @include('validation')

    {{ Form::model($polaKerja,['url'=>'polakerja/'.$polaKerja->id,'method'=>'PUT'])}}

    @include('polaKerja.form')
    
    {{ Form::close()}}
@endsection