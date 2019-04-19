<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Jabatan;
use App\Departemen;
use App\StatusKawin;

class KaryawanController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['karyawan'] = Karyawan::join('departemen','departemen.kode_departemen','=','karyawan.kode_departemen')
                            ->join('jabatan','jabatan.kode_jabatan','=','karyawan.kode_jabatan')
                            ->get();
        return view('karyawan.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['departemen'] = Departemen::pluck('nama_departemen','kode_departemen');
        $data['jabatan'] = Jabatan::pluck('nama_jabatan','kode_jabatan');
        $data['status_kawin'] = StatusKawin::pluck('keterangan','kode_status_kawin');
        return view('karyawan.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:karyawan|max:10|min:5',
            'nama' => 'required|min:5',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
        ]);

        if($request->hasFile('foto'))
        {
             // upload foto
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath,$fileName);
        }else
        {
            $fileName = null;
        }

        $karyawan  = new karyawan();
        $karyawan->nik                  = $request->nik;
        $karyawan->nama                 = $request->nama;
        $karyawan->tanggal_lahir        = $request->tanggal_lahir;
        $karyawan->alamat        = $request->alamat;
        $karyawan->kode_status_kawin    = $request->kode_status_kawin;
        $karyawan->jenis_kelamin        = $request->jenis_kelamin;
        $karyawan->kode_departemen      = $request->kode_departemen;
        $karyawan->kode_jabatan         = $request->kode_jabatan;
        $karyawan->tanggal_masuk        = $request->tanggal_masuk;
        $karyawan->foto                 = $fileName;
        $karyawan->gaji_pokok           = $request->gaji_pokok;
        $karyawan->save();
        return redirect('karyawan')->with('message','Berhasil Menyimpan Data karyawan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nik)
    {
        $data['karyawan'] = karyawan::find($nik);
        $data['departemen'] = Departemen::pluck('nama_departemen','kode_departemen');
        $data['jabatan'] = Jabatan::pluck('nama_jabatan','kode_jabatan');
        $data['status_kawin'] = StatusKawin::pluck('keterangan','kode_status_kawin');
        return view('karyawan.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nik)
    {
        $request->validate([
            'nama' => 'required|min:5',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
        ]);

        

        $karyawan  = Karyawan::find($nik);
        $karyawan->nama                 = $request->nama;
        $karyawan->tanggal_lahir        = $request->tanggal_lahir;
        $karyawan->alamat               = $request->alamat;
        $karyawan->kode_status_kawin    = $request->kode_status_kawin;
        $karyawan->jenis_kelamin        = $request->jenis_kelamin;
        $karyawan->kode_departemen      = $request->kode_departemen;
        $karyawan->kode_jabatan         = $request->kode_jabatan;
        $karyawan->tanggal_masuk        = $request->tanggal_masuk;
        $karyawan->gaji_pokok           = $request->gaji_pokok;
    
        if($request->hasFile('foto'))
        {
             // upload foto
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath,$fileName);
            $karyawan->foto                 = $fileName;
        }

        $karyawan->update();
        return redirect('karyawan')->with('message','Berhasil Menyimpan Perubahan Data karyawan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_karyawan)
    {
        $karyawan  = karyawan::find($kode_karyawan);
        $karyawan->delete();
        return redirect('karyawan')->with('message','Berhasil Menghapus Data karyawan');
    }

    function polaKerja($nik)
    {
        $data['karyawan']          =    \DB::table('karyawan')->where('nik',$nik)->first();
        $data['polaKerjaKaryawan'] =    \DB::table('pola_kerja_karyawan')
                                        ->join('pola_kerja','pola_kerja.id','=','pola_kerja_karyawan.pola_kerja_id')
                                        ->where('pola_kerja_karyawan.nik',$nik)
                                        ->orderBy('pola_kerja_karyawan.tanggal','ASC')
                                        ->paginate(4);
        return view('karyawan.polakerja',$data);
    }

    function kehadiran($nik)
    {
        $data['riwayatKehadiran']   =   \DB::table('view_riwayat_kehadiran')
                                        ->where('nik',$nik)
                                        ->orderBy('tanggal_masuk','ASC')
                                        ->paginate(7);
        $data['karyawan']           =  \DB::table('karyawan')->where('nik',$nik)->first();
        return view('karyawan.kehadiran',$data);
    }

    function lembur($nik)
    {
        $data['riwayatKehadiran']   =   \DB::table('lembur')
                                        ->where('nik',$nik)
                                        ->orderBy('tanggal_masuk','ASC')
                                        ->paginate(7);
        $data['karyawan']           =  \DB::table('karyawan')->where('nik',$nik)->first();
        return view('karyawan.lembur',$data);
    }

}
