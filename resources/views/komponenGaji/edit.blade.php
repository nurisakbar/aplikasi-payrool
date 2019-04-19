@extends('template')
@section('title','Edit Komponen Gaji')
@section('content')

    @include('validation')

    {{ Form::model($komponenGaji,['url'=>'komponengaji/'.$komponenGaji->kode_komponen,'method'=>'PUT'])}}

    @include('komponenGaji.form')
    
    {{ Form::close()}}
@endsection