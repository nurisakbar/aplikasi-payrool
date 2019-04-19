@extends('template')
@section('title','Input Data Kehadiran')
@section('content')

    @include('validation')
    @include('alert')

    {{ Form::open(['url'=>'kehadiran'])}}

    @include('kehadiran.form')

    {{ Form::close()}}
@endsection