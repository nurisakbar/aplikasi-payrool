@extends('template')
@section('title','Input Data Pola Kerja')
@section('content')

    @include('validation')

    {{ Form::open(['url'=>'polakerja'])}}

    @include('polaKerja.form')

    {{ Form::close()}}
@endsection