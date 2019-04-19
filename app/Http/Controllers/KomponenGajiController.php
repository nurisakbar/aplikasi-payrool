<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KomponenGaji;
class KomponenGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['komponenGaji'] = komponenGaji::all();
        return view('komponenGaji.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('komponenGaji.create');
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
            'kode_komponen' => 'required|unique:komponen_gaji|max:4|min:4',
            'nama_komponen' => 'required|min:5',
            'nilai' => 'required',
        ]);

        $komponenGaji  = new KomponenGaji();
        $komponenGaji->kode_komponen = $request->kode_komponen;
        $komponenGaji->nama_komponen = $request->nama_komponen;
        $komponenGaji->nilai = $request->nilai;
        $komponenGaji->jenis = $request->jenis;
        $komponenGaji->save();
        return redirect('komponengaji')->with('message','Berhasil Menyimpan Data Komponen Gaji');
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
    public function edit($kode_komponenGaji)
    {
        $data['komponenGaji'] = komponenGaji::find($kode_komponenGaji);
        return view('komponenGaji.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_komponenGaji)
    {
        $request->validate([
            'nama_komponen' => 'required|min:5',
            'nilai' => 'required',
        ]);

        $komponenGaji  = KomponenGaji::find($kode_komponenGaji);
        $komponenGaji->nama_komponen = $request->nama_komponen;
        $komponenGaji->nilai = $request->nilai;
        $komponenGaji->jenis = $request->jenis;
        $komponenGaji->update();
        return redirect('komponengaji')->with('message','Berhasil Melakukan Update Data komponenGaji');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_komponenGaji)
    {
        $komponenGaji  = komponenGaji::find($kode_komponenGaji);
        $komponenGaji->delete();
        return redirect('komponengaji')->with('message','Berhasil Menghapus Data komponenGaji');
    }
}
