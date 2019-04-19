<table class="table table-bordered">
        <tr>
            <td width="150">Nama Pola Kerja</td>
            <td>{{ Form::text('pola_kerja',null,['class'=>'form-control','placeholder'=>'Nama Pola Kerja Karyawan'])}}</td>
        </tr>
        <tr>
            <td width="150">Jam Masuk & Pulang</td>
            <td>
                <div class="row">
                    <div class="col-md-2">
                        {{ Form::text('jam_masuk',null,['class'=>'form-control','placeholder'=>'Ex : 08:00'])}}
                    </div>
                    <div class="col-md-2">
                        {{ Form::text('jam_pulang',null,['class'=>'form-control','placeholder'=>'exa : 16:00'])}}
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                     Simpan Data</button>
                <a href="/polakerja" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i>
                     Kembali</a>
            </td>
        </tr>
    </table>