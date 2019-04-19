<table class="table table-bordered">
        <tr>
            <td width="200">Tanggal</td>
            <td>{{ Form::date('tanggal',null,['class'=>'form-control','placeholder'=>'Tanggal'])}}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>{{ Form::text('keterangan',null,['class'=>'form-control','placeholder'=>'Keterangan Hari Libur'])}}</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                     Simpan Data</button>
                <a href="/kalenderkerja" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i>
                     Kembali</a>
            </td>
        </tr>
    </table>