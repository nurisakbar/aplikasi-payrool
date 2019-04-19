<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;

class LemburController extends Controller
{
    function index()
    {
        if(session('periode_lembur')!=null)
            {
                $periode = session('periode_lembur');
            }else
            {
                $periode = date('y-m-d');
            }

            

        $data['riwayatLembur'] = \DB::table('lembur')
                                ->select('lembur.*','karyawan.nama')
                                ->join('karyawan','karyawan.nik','=','lembur.nik')
                                ->whereRaw("date(lembur.tanggal_masuk)='$periode'")
                                ->get();
        return view('lembur.index',$data);
    }

    function create()
    {
        $data['karyawan'] = Karyawan::select('nama')->get();
        return view('lembur.create',$data);
    }

    function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_masuk' => 'required',
            'tanggal_pulang' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'durasi_lembur'=>'required'
        ]);

        $karyawan = \DB::table('karyawan')->where('nama',$request->nama)->first();
        if($karyawan!=null)
        {
            // insert data
            $data = [
                'nik'                   =>  $karyawan->nik,
                'tanggal_masuk'         =>  $request->tanggal_masuk.' '.$request->jam_masuk,
                'tanggal_pulang'        =>  $request->tanggal_pulang.' '.$request->jam_pulang,
                'durasi_lembur'         =>  $request->durasi_lembur
            ];
            
            \DB::table('lembur')->insert($data);
            return Redirect('/lembur')->with('message','Data Kehadiran : '.$request->nama .'Berhasil Disimpan');
        }else
        {
            return Redirect::back()->with('message','Karyawan Dengan Nama : '.$request->nama .' Tidak Ditemukan');
        }
    }


    function ubahPeriodeLembur(Request $request)
    {
        session(['periode_lembur'=>$request->periode_lembur]);
        return redirect('lembur')->with('message','Laporan Periode Lembur Sudah Diubah');
    }

    function destroy($id,$url)
    {
        $lembur = \DB::table('lembur')->where('id',$id)->first();

        $delete = \DB::table('lembur')->where('id',$id)->delete();


        if($url=='lembur')
        {
            return redirect('lembur')->with('message','Riwayat Lembur Sudah Dihapus');
        }else
        {
            return redirect('karyawan/'.$lembur->nik.'/lembur')->with('message','Riwayat Lembur Sudah Dihapus');
        }        
    }
}
