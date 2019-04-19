<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KelompokGaji;
use App\KomponenGaji;
class KelompokGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kelompokGaji'] = kelompokGaji::all();
        return view('kelompokgaji.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelompokgaji.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'kode_kelompok_gaji' => 'required|unique:kode_kelompok_gaji|max:30|min:5',
        //     'nama_kelompok_gaji'=>'required'
        // ]);

        $kelompokgaji  = new kelompokgaji();
        $kelompokgaji->kode_kelompok_gaji = $request->kode_kelompok_gaji;
        $kelompokgaji->nama_kelompok_gaji = $request->nama_kelompok_gaji;
        $kelompokgaji->save();
        return redirect('kelompokgaji')->with('message','Berhasil Menyimpan Data Kelompok Gaji');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['karyawan'] = \DB::table('karyawan')->get();
        $data['kelompokgaji'] = kelompokgaji::find($id);
        $data['anggota'] = \DB::table('anggota_kelompok_kerja')
                            ->join('karyawan','karyawan.nik','=','anggota_kelompok_kerja.nik')
                            ->where('anggota_kelompok_kerja.kelompok_kerja_id',$id)
                            ->get();
        return view('kelompokgaji.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['komponenGaji'] = KomponenGaji::pluck('nama_komponen','kode_komponen');
        $data['kelompokGaji'] = kelompokGaji::find($id);
        $data['komponen']     = \DB::table('komponen_kelompok_gaji')->join('komponen_gaji','komponen_gaji.kode_komponen','=','komponen_kelompok_gaji.kode_komponen_gaji')->get();
        return view('kelompokgaji.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kelompok_kerja' => 'required|min:5',
        ]);

        $kelompokgaji  = kelompokgaji::find($id);
        $kelompokgaji->kelompok_kerja = $request->kelompok_kerja;
        $kelompokgaji->update();
        return redirect('kelompokgaji')->with('message','Berhasil Melakukan Update Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelompokgaji  = kelompokgaji::find($id);
        $kelompokgaji->delete();
        return redirect('kelompokgaji')->with('message','Berhasil Menghapus Data kelompokgaji');
    }


    function tambahKomponen(Request $request)
    {
        $data = [
            'kode_kelompok_gaji'=>$request->kode_kelompok_gaji,
            'kode_komponen_gaji'=>$request->kode_komponen_gaji,
            'penghitung'=>'test'
        ];
        \DB::table('komponen_kelompok_gaji')->insert($data);
        return redirect('kelompokgaji/'.$request->kode_kelompok_gaji.'/edit')->with('message','Komponen Gaji Berhasil Ditambahkan');
    }

    function hapusKomponen($id)
    {
        $komponen = \DB::table('komponen_kelompok_gaji')->where('id',$id);
        $row      = $komponen->first();
        $komponen->delete();
        return redirect('kelompokgaji/'.$row->kode_kelompok_gaji.'/edit')->with('message','Komponen Gaji Berhasil Dihapus');
    }
}
