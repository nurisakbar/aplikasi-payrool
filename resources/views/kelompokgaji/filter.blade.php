<table class="table table-bordered">
    <tr>
        <td>Filter Laporan</td>
        <td>
            {{ Form::select('bulan',['01'=>'Januari','02'=>'febrauri'],null,['class'=>'form-control'])}}
        </td>
        <td>
            {{ Form::select('tahun',['2019'=>'2019'],null,['class'=>'form-control'])}}
        </td>
        <td>
            <button type="submit" class="btn btn-danger">Tampilkan</button>
        </td>
    </tr>
</table>