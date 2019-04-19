@extends('template')
@section('title','Input Data Komponen Gaji')
@section('content')

    @include('validation')

    {{ Form::open(['url'=>'komponengaji'])}}

    @include('komponenGaji.form')

    {{ Form::close()}}
@endsection