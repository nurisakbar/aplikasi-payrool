@extends('template')
@section('title','Input Data Departemen')
@section('content')

    @include('validation')

    {{ Form::open(['url'=>'departemen'])}}

    @include('departemen.form')

    {{ Form::close()}}
@endsection