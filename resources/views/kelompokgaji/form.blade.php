<table class="table table-bordered">
        <tr>
            <td width="150">Kode Kelompok Gaji</td>
            <td>{{ Form::text('kode_kelompok_gaji',null,['class'=>'form-control','placeholder'=>'Kode Kelompok Gaji'])}}</td>
        </tr>
        <tr>
                <td width="150">Nama Kelompok Gaji</td>
                <td>{{ Form::text('nama_kelompok_gaji',null,['class'=>'form-control','placeholder'=>'Nama Kelompok Gaji'])}}</td>
            </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                     Simpan</button>
                <a href="/kelompokgaji" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i>
                     Kembali</a>
            </td>
        </tr>
    </table>