@extends('template')
@section('title','Input Data Kelompok Gaji')
@section('content')

    @include('validation')

    {{ Form::open(['url'=>'kelompokgaji'])}}

    @include('kelompokgaji.form')

    {{ Form::close()}}
@endsection