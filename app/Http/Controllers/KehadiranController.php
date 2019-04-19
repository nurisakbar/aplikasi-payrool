<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kehadiran;
use App\karyawan;
use App\StatusKehadiran;
use Redirect;

use App\Exports\KehadiranExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KehadiranImport;

class KehadiranController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    

    function index()
    {
        $data['kehadiran'] = Karyawan::select('karyawan.nik','departemen.nama_departemen','karyawan.nama','kehadiran.id','kehadiran.tanggal_masuk','kehadiran.tanggal_pulang','status_kehadiran.status_kehadiran')
                            //->leftJoin('kehadiran','kehadiran.nik','=','karyawan.nik')
                            ->leftjoin('kehadiran', function ($join) {

                                if(session('periode_kehadiran')!=null)
                                {
                                    $periode = session('periode_kehadiran');
                                }else
                                {
                                    $periode = date('y-m-d');
                                }

                                $join->on('kehadiran.nik','=','karyawan.nik')
                                ->whereRaw("date(kehadiran.tanggal_masuk)='$periode'");
                            })
                            ->join('departemen','karyawan.kode_departemen','=','departemen.kode_departemen')
                            ->leftJoin('status_kehadiran','status_kehadiran.kode_status_kehadiran','=','kehadiran.kode_status_kehadiran')
                            ->get();
        return view('kehadiran.index',$data);
    }

    function create()
    {
        $data['karyawan'] = Karyawan::select('nama')->get();
        $data['statusKehadiran'] = StatusKehadiran::pluck('status_kehadiran','kode_status_kehadiran');
        return view('kehadiran.create',$data);
    }

    function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_masuk' => 'required',
            'tanggal_pulang' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
        ]);

        $karyawan = \DB::table('karyawan')->where('nama',$request->nama)->first();
        if($karyawan!=null)
        {
            // insert data
            $data = [
                'nik'=>$karyawan->nik,
                'tanggal_masuk' => $request->tanggal_masuk.' '.$request->jam_masuk,
                'tanggal_pulang'=>$request->tanggal_pulang.' '.$request->jam_pulang,
                'kode_status_kehadiran'=>$request->kode_status_kehadiran
            ];
            
            \DB::table('kehadiran')->insert($data);
            return Redirect('/kehadiran')->with('message','Data Kehadiran : '.$request->nama .'Berhasil Disimpan');
        }else
        {
            return Redirect::back()->with('message','Karyawan Dengan Nama : '.$request->nama .' Tidak Ditemukan');
        }
    }


    function ubahPeriodeKehadiran(Request $request)
    {
        session(['periode_kehadiran'=>$request->periode_kehadiran]);
        return redirect('kehadiran')->with('message','Laporan Periode Kehadiran Sudah Diubah');
    }

    function excel(Request $request)
    {

        return Excel::download(new KehadiranExport($request->tanggal_mulai,$request->tanggal_selesai), 'laporan-kehadiran.xlsx');
    }

    function import(request $request)
    {
        $file       = $request->file('file');
        $fileName   = $file->getClientOriginalName();
         //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath,$fileName);

        Excel::import(new KehadiranImport, public_path().'/uploads/'.$fileName);

        return redirect('kehadiran')->with('message','Laporan Kehadiran berhasil Di Import');

    }
}
