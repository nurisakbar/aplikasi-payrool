<?php

namespace App\Exports;

use App\Kehadiran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KehadiranExport implements FromView, ShouldAutoSize
{
    public $tanggal_mulai;
    public $tanggal_akhir;


    function __construct($awal,$akhir)
    {
        $this->tanggal_mulai = $awal;
        $this->tanggal_akhir = $akhir;
    }


    public function view(): View
    {
        $sql = "select vk.*,k.nama
        from view_riwayat_kehadiran as vk
        join karyawan as k on k.nik=vk.nik
        where date(vk.tanggal_masuk) between '".$this->tanggal_mulai."' and '".$this->tanggal_akhir."'";

        $data['riwayatKehadiran'] = \DB::select($sql);
        return view('kehadiran.excel',$data);
    }
}
