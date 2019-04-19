@extends('template')
@section('title','Input Data Kelompok Kerja')
@section('content')

    @include('validation')

    {{ Form::open(['url'=>'kelompokkerja'])}}

    @include('kelompokkerja.form')

    {{ Form::close()}}
@endsection