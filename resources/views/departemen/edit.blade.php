@extends('template')
@section('title','Edit Data Departemen')
@section('content')

    @include('validation')

    {{ Form::model($departemen,['url'=>'departemen/'.$departemen->kode_departemen,'method'=>'PUT'])}}

    @include('departemen.form')
    
    {{ Form::close()}}
@endsection