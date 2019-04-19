
<table class="table table-bordered">
        <tr>
            <td width="200">No Induk Karyawan</td>
            <td>
                @if(isset($karyawan))
                    {{ Form::text('nik',null,['class'=>'form-control','placeholder'=>'No Induk Karyawan','readOnly'=>''])}}</td>
                @else
                    {{ Form::text('nik',null,['class'=>'form-control','placeholder'=>'No Induk Karyawan'])}}</td>
                @endif
        </tr>
        <tr>
            <td>Nama Karyawan</td>
            <td>{{ Form::text('nama',null,['class'=>'form-control','placeholder'=>'Nama Karyawan'])}}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>
                <div class="row">
                    <div class="col-md-3">
                            {{ Form::date('tanggal_lahir',null,['class'=>'form-control','placeholder'=>'Tanggal Lahir'])}}
                    </div>
                </div></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>{{ Form::textarea('alamat',null,['class'=>'form-control','placeholder'=>'Alamat Lengkap','rows'=>2])}}</td>
        </tr>
        <tr>
            <td>Status Kawin</td>
            <td>{{ Form::select('kode_status_kawin',$status_kawin,null,['class'=>'form-control'])}}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>
                <div class="row">
                    <div class="col-md-3">
                            {{ Form::select('jenis_kelamin',['L'=>'Laki laki','P'=>'Perempuan'],null,['class'=>'form-control'])}}
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Departemen & Jabatan</td>
            <td>
                <div class="row">
                    <div class="col-md-5">
                            {{ Form::select('kode_departemen',$departemen,null,['class'=>'form-control'])}}
                    </div>
                    <div class="col-md-5">
                            {{ Form::select('kode_jabatan',$jabatan,null,['class'=>'form-control'])}}
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Tanggal Masuk</td>
            <td>{{ Form::date('tanggal_masuk',null,['class'=>'form-control','placeholder'=>'Tunjangan Masuk'])}}</td>
        </tr>
        <tr>
                <td>Gaji Pokok</td>
                <td>{{ Form::text('gaji_pokok',null,['class'=>'form-control','placeholder'=>'Gaji Pokok'])}}</td>
            </tr>

        <tr><td>Upload Foto</td>
            <td>
                {{ Form::file('foto')}}
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                     Simpan Data</button>
                <a href="/jabatan" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i>
                     Kembali</a>
            </td>
        </tr>
    </table>