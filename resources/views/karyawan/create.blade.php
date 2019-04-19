@extends('template')
@section('title','Input Data Karyawan')
@section('content')

    @include('validation')

    {{ Form::open(['url'=>'karyawan','files'=>true])}}

    @include('karyawan.form')

    {{ Form::close()}}
@endsection