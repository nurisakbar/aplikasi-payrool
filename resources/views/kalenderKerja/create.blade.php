@extends('template')
@section('title','Input Data Kalender Kerja')
@section('content')

    @include('validation')

    {{ Form::open(['url'=>'kalenderkerja'])}}

    @include('kalenderKerja.form')

    {{ Form::close()}}
@endsection