<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\PindahRiwayatKehadiranFromTemp;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{
 

    function kehadiran(request $request)
    {

        $data = $request->data;

      //return $data;
        
        $dataRiwayat = [];

        foreach($data as $row)
        {
            //return $row['masuk;
            //dd($row);

            $masuk =  $row['masuk'];
            $keluar = $row['keluar'];
            $DIN    = $row['DIN'];
            $nik    = \DB::table('karyawan')->where('DIN',$DIN)->first();


            $riwayatKehadiran = [];

            if(isset($nik))
            {
                $dataRiwayat[] = [
                    'nik'                   =>  $nik->nik,
                    'tanggal_masuk'           =>  $masuk,
                    'tanggal_pulang'          =>  $keluar,
                    'kode_status_kehadiran'      =>'H'
                ];
            }
        }
        
        $insert = \DB::table('kehadiran')->insert($dataRiwayat);
    }

}
