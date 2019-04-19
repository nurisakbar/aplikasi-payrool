<table class="table table-bordered">
        <tr>
            <td width="200">Kode Departemen</td>
            <td>{{ Form::text('kode_departemen',null,['class'=>'form-control','placeholder'=>'Kode Departemen'])}}</td>
        </tr>
        <tr>
            <td>Nama Departemen</td>
            <td>{{ Form::text('nama_departemen',null,['class'=>'form-control','placeholder'=>'Nama Departemen'])}}</td>
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