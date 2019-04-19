<table class="table table-bordered">
        <tr>
            <td width="150">Kelompok Kerja</td>
            <td>{{ Form::text('kelompok_kerja',null,['class'=>'form-control','placeholder'=>'Nama Kelompok Kerja'])}}</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                     Simpan Data</button>
                <a href="/kelompokkerja" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i>
                     Kembali</a>
            </td>
        </tr>
    </table>