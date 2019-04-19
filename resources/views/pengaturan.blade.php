@extends('template')
@section('title','Setting Aplikasi')
@section('content')

    @include('validation')

    {{ Form::model($pengaturan,['url'=>'pengaturan','files'=>true])}}

    @include('alert')

    <div class="row">
        <div class="col-md-8">
                <table class="table table-bordered">
                        <tr>
                            <td width="200">Nama Perusahaan</td>
                            <td>{{ Form::text('nama_perusahaan',null,['class'=>'form-control','placeholder'=>'Nama Perusahaan'])}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ Form::text('alamat_perusahaan',null,['class'=>'form-control','placeholder'=>'Alamat Perusahaan'])}}</td>
                        </tr>
                        <tr>
                            <td width="200">Email & Telpon</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-5">
                                        {{ Form::text('email',null,['class'=>'form-control','placeholder'=>'Email'])}}
                                    </div>
                                    <div class="col-md-5">
                                        {{ Form::text('no_telpon',null,['class'=>'form-control','placeholder'=>'No Telpon'])}}
                                        
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                                     Simpan Data</button>
                                <a href="/departemen" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i>
                                     Kembali</a>
                            </td>
                        </tr>
                    </table>
        </div>
        <div class="col-md-3">
            <table class="table table-bordered">
                <tr><td><img src="{{ asset('uploads/'.$pengaturan->logo.'')}}" width="200"></td></tr>
                <tr>
                    <td>
                        Ganti Logo : {{ Form::file('logo')}}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    

    {{ Form::close()}}
@endsection