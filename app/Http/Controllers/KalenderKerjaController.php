<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KalenderKerja;
class KalenderKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kalenderKerja'] = kalenderKerja::all();
        return view('kalenderKerja.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kalenderKerja.create');
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
            'tanggal' => 'required|unique:kalender_kerja',
            'keterangan' => 'required|min:5',
        ]);

        $kalenderKerja  = new kalenderKerja();
        $kalenderKerja->tanggal = $request->tanggal;
        $kalenderKerja->keterangan = $request->keterangan;
        $kalenderKerja->save();
        return redirect('kalenderkerja')->with('message','Berhasil Menyimpan Data');
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
    public function edit($id)
    {
        $data['kalenderKerja'] = kalenderKerja::find($id);
        return view('kalenderKerja.edit',$data);
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
            'keterangan' => 'required|min:5',
        ]);

        $kalenderKerja  = kalenderKerja::find($id);
        $kalenderKerja->keterangan = $request->keterangan;
        $kalenderKerja->update();
        return redirect('kalenderkerja')->with('message','Berhasil Melakukan Update Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kalenderKerja  = kalenderKerja::find($id);
        $kalenderKerja->delete();
        return redirect('kalenderkerja')->with('message','Berhasil Menghapus Data kalenderKerja');
    }
}
