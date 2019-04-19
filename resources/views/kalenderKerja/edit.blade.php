@extends('template')
@section('title','Edit Data Kalender Kerja')
@section('content')

    @include('validation')

    {{ Form::model($kalenderKerja,['url'=>'kalenderkerja/'.$kalenderKerja->id,'method'=>'PUT'])}}

    @include('kalenderKerja.form')
    
    {{ Form::close()}}
@endsection