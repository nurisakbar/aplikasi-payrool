@extends('template')
@section('title','Input Data Jabatan')
@section('content')

    @include('validation')

    {{ Form::open(['url'=>'jabatan'])}}

    @include('jabatan.form')

    {{ Form::close()}}
@endsection