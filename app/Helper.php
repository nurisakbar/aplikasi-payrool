<?php


function hitungJmlKehadiran($nik,$periode)
{
    $sql = "select count(*) as jml_kehadiran from kehadiran where nik='$nik' and left(cast(tanggal_masuk as text),7)='$periode'";
    $jmlKehadiran = \DB::select($sql);
    return $jmlKehadiran[0]->jml_kehadiran;
}

function chekKehadiran($nik,$tanggal)
{
    $kehadiran = \DB::table('kehadiran')
                ->where('nik',$nik)
                ->whereRaw("cast(tanggal_masuk as date)='".$tanggal."'")
                ->first();
    if(isset($kehadiran))
    {
        return $kehadiran->kode_status_kehadiran;
    }else
    {
        return '-';
    }
}


function chekLembur($nik,$tanggal)
{
    $lembur = \DB::table('lembur')
                ->where('nik',$nik)
                ->whereRaw("cast(tanggal_masuk as date)='".$tanggal."'")
                ->first();

    if(isset($lembur))
    {
        return $lembur->durasi_lembur;
    }else
    {
        return '-';
    }
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}
?>