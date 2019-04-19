<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KelompokKerja;
use App\polaKerja;

class KelompokKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kelompokKerja'] = kelompokKerja::all();
        return view('kelompokkerja.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelompokkerja.create');
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
            'kelompok_kerja' => 'required|unique:kelompok_kerja|max:30|min:5',
        ]);

        $kelompokkerja  = new kelompokKerja();
        $kelompokkerja->kelompok_kerja = $request->kelompok_kerja;
        $kelompokkerja->save();
        return redirect('kelompokkerja')->with('message','Berhasil Menyimpan Data');
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
        $data['kelompokKerja'] = kelompokKerja::find($id);
        $data['anggota'] = \DB::table('anggota_kelompok_kerja')
                            ->join('karyawan','karyawan.nik','=','anggota_kelompok_kerja.nik')
                            ->where('anggota_kelompok_kerja.kelompok_kerja_id',$id)
                            ->get();
        return view('kelompokkerja.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['kelompokKerja'] = kelompokKerja::find($id);
        return view('kelompokkerja.edit',$data);
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

        $kelompokkerja  = kelompokKerja::find($id);
        $kelompokkerja->kelompok_kerja = $request->kelompok_kerja;
        $kelompokkerja->update();
        return redirect('kelompokkerja')->with('message','Berhasil Melakukan Update Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelompokkerja  = kelompokkerja::find($id);
        $kelompokkerja->delete();
        return redirect('kelompokkerja')->with('message','Berhasil Menghapus Data kelompokkerja');
    }

    function tambahAnggota(Request $request)
    {
        // /return $request->all();
        $karyawan = \DB::table('karyawan')->where('nama',$request->nama)->first();

        if($karyawan!=null)
        {

            $data = ['nik' =>$karyawan->nik,'kelompok_kerja_id'=>$request->id];
            \DB::table('anggota_kelompok_kerja')->insert($data);
            return Redirect('kelompokkerja/'.$request->id)->with('message','Data Anggota : '.$request->nama .'Berhasil Ditambahkan');

        }else
        {
            return Redirect('kelompokkerja/'.$request->id)->with('message','Data Karyawan : '.$request->nama .'Tidak Ditemukan');
        }
    }

    function hapusAnggota($id)
    {
        $anggota = \DB::table('anggota_kelompok_kerja')
                    ->select('anggota_kelompok_kerja.kelompok_kerja_id','karyawan.nama')
                    ->join('karyawan','karyawan.nik','=','anggota_kelompok_kerja.nik')
                    ->where('anggota_kelompok_kerja.id',$id)
                    ->first();

        \DB::table('anggota_kelompok_kerja')
            ->where('id',$id)
            ->delete();

        return redirect('kelompokkerja/'.$anggota->kelompok_kerja_id)->with('message','Anggota Dengan Nama '.$anggota->nama.' Sudah Dihapus');
    }

    function polaKerja($id)
    {
        
        $data['kelompokKerja']      = kelompokKerja::find($id);
        $data['polaKerja']          = PolaKerja::pluck('pola_kerja','id');
        $data['polakerjaKelompok']  = \DB::table('pola_kerja_kelompok_karyawan')
                                    ->select('pola_kerja_kelompok_karyawan.tanggal','pola_kerja_kelompok_karyawan.id','pola_kerja.pola_kerja','pola_kerja.jam_masuk','pola_kerja.jam_pulang')
                                    ->join('pola_kerja','pola_kerja.id','=','pola_kerja_kelompok_karyawan.pola_kerja_id')
                                    ->paginate(7);
        return view('kelompokkerja.polakerja',$data);
    }

    function simpanPolaKerja(Request $request)
    {
        //return $request->all();

        $period = new \DatePeriod(
            new \DateTime($request->dari_tanggal),
            new \DateInterval('P1D'),
            new \DateTime(date('Y-m-d', strtotime('1 day', strtotime($request->sampai_tanggal))))
       );

       $dataPolaKerja = [];

       // insert pola kerja kelompok karyawan

       foreach ($period as $key => $value) {
        $dataPolaKerja[] = [
                            'tanggal'           =>  $value->format('Y-m-d'),
                            'pola_kerja_id'     =>  $request->pola_kerja,
                            'kelompok_kerja_id' =>  $request->kelompok_kerja_id,
                            'created_at'        =>  date('Y-m-d'),
                            'updated_at'        =>  date('Y-m-d'),
            ];
        }

        \DB::table('pola_kerja_kelompok_karyawan')->insert($dataPolaKerja);

        // insert pola kerja karyawan

        $polaKerjaKaryawan = [];

        $karyawan = \DB::table('anggota_kelompok_kerja')
                    ->where('kelompok_kerja_id',$request->kelompok_kerja_id)
                    ->get();
        foreach($karyawan as $k)
        {
            foreach ($period as $key => $value) {
                $polaKerjaKaryawan[] = [
                                        'nik'           =>  $k->nik,
                                        'pola_kerja_id' =>  $request->pola_kerja,
                                        'tanggal'       =>  $value->format('Y-m-d')];
            }
            
        }

        \DB::table('pola_kerja_karyawan')->insert($polaKerjaKaryawan);

        return redirect('kelompokkerja/'.$request->kelompok_kerja_id.'/polakerja')->with('message','Data Kelompok Kerja Berhasil Disimpan');
    }

    function hapusPolaKerja($id)
    {
        $polaKerja = \DB::table('pola_kerja_kelompok_karyawan')->where('id',$id)->first();

        \DB::table('pola_kerja_kelompok_karyawan')->where('id',$id)->delete();
        
        return redirect('kelompokkerja/'.$polaKerja->kelompok_kerja_id.'/polakerja')->with('message','Data Kelompok Kerja Berhasil Dihapus');
    }
}
