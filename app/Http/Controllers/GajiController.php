<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gaji;
use App\KomponenGaji;
use Fpdf;

class GajiController extends Controller
{
    function index()
    {
        $periodeGaji = Session('periode_gaji');
        if($periodeGaji=='')
        {
            $periode = date('Ym');
        }else
        {
            $periode = $periodeGaji;
        }

        $data['riwayatGaji'] = Gaji::join('karyawan','karyawan.nik','=','gaji.nik')
                                ->where('gaji.periode',$periode)
                                ->get();
        $data['periodeGaji'] = Gaji::pluck('periode','periode');
        return view('gaji.index',$data);
    }

    function store(Request $request)
    {
        $periode = $request->periode;

        $data = [];

        $karaywan = \DB::table('karyawan')->select('nik')->get();
        foreach($karaywan as $k)
        {
            $data[] = ['nik'=>$k->nik,'periode'=>$periode];
        }

        \DB::table('gaji')->insert($data);
        return redirect('gaji')->with('message','Periode Gaji '.$periode.' Sudah Dibuat');
    }

    function ubahPeriodeGaji(Request $request)
    {
        Session(['periode_gaji'=>$request->periode]);
        return redirect('gaji')->with('message','Periode Gaji Diset Menjadi : '.$request->periode);
    }

    function show($id)
    {
        
        $data['komponenGaji'] = KomponenGaji::pluck('nama_komponen','kode_komponen');
        $gaji = Gaji::find($id);

        

        $periode = substr($gaji->periode,0,4).'-'.substr($gaji->periode,4,2);


        $data['gaji'] = $gaji;
        $data['karyawan'] = \DB::table('karyawan')
                            ->join('jabatan','karyawan.kode_jabatan','=','jabatan.kode_jabatan')
                            ->where('karyawan.nik',$gaji->nik)
                            ->first();
        $data['gajiDetail'] = \DB::table('gaji_detail')
                             ->join('komponen_gaji','komponen_gaji.kode_komponen','=','gaji_detail.kode_komponen')
                              ->where('gaji_detail.gaji_id',$id)
                              ->get();
        $data['hitungLembur'] = \DB::select("select sum(durasi_lembur) as durasi_lembur 
                                            from lembur where left(cast(tanggal_masuk as text),7)='".$periode."' 
                                            and nik='".$gaji->nik."'");
        $data['periode'] = $periode;
        return view('gaji.show',$data);
    }

    function tambahKomponenDetail(Request $request)
    {
        $data = ['kode_komponen'=>$request->kode_komponen,'gaji_id'=>$request->gaji_id];
        \DB::table('gaji_detail')->insert($data);

        return redirect('gaji/'.$request->gaji_id)->with('message','Komponen Gaji Berhasil Ditambahkan');
    }

    function hapusKomponengajiDetail($id)
    {
        $gaji = \DB::table('gaji_detail')->where('id',$id)->first();
        \DB::table('gaji_detail')->where('id',$id)->delete();
        return redirect('gaji/'.$gaji->gaji_id)->with('message','Komponen gaji Berhasil Dihapus');
    }



    function pdf($id)
    {
        // ========= Query Database Untuk Mendapatkan Data Gaji =======================

        $gaji                   = Gaji::find($id);
        $karyawan               = \DB::table('karyawan')
                                ->join('jabatan','karyawan.kode_jabatan','=','jabatan.kode_jabatan')
                                ->where('karyawan.nik',$gaji->nik)
                                ->first();
        $pengaturan             = \DB::table('pengaturan')->where('id',1)->first();;

        $periode_tahun = substr($gaji->periode,0,4);
        $periode_bulan = substr($gaji->periode,4,2);

        $periode_sekarang = '01/'.substr($gaji->periode,4,2).'/'.substr($gaji->periode,0,4);

        $periode_bln_depan = '01/'.date('m-Y', strtotime('+1 month', strtotime('2019-04')));

        Fpdf::AddPage('L','A5');
        Fpdf::SetFont('Arial', 'B', 14);
        Fpdf::Cell(190, 7, 'LAPORAN SLIP GAJI KARYAWAN',1,1,'C');
        Fpdf::Cell(190, 16, '',1,1,'C');
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::text(12,22,'Nama Perusahaan');
        Fpdf::text(38,22,' : '.$pengaturan->nama_perusahaan);
        Fpdf::text(12,26,'Periode');
        Fpdf::text(38,26,' : '.$periode_sekarang.' - '.$periode_bln_depan);
        Fpdf::text(12,30,'Departemen');
        Fpdf::text(38,30,' : HRD/ Admin');


        Fpdf::text(110,22,'NIK');
        Fpdf::text(136,22,' : '.$karyawan->nik);
        Fpdf::text(110,26,'Nama Karyawan');
        Fpdf::text(136,26,' : '.$karyawan->nama);
        Fpdf::text(110,30,'Jabatan');
        Fpdf::text(136,30,' : '.$karyawan->nama_jabatan);

        Fpdf::Cell(190, 90, '',1,1,'C');
        // ---------------------------------------
        Fpdf::text(12,40,'Penerimaan ( +)');
        Fpdf::line(12, 75, 210-20, 75);
        Fpdf::line(12, 42, 110-20, 42);
        Fpdf::line(110, 42, 210-20, 42);


        // KALKULASI KOMPONEN GAJI --------------------------

        $total_penerimaan = 0;
        $total_potongan = 0;

        $jml_kehadiran = hitungJmlKehadiran($karyawan->nik,$periode_tahun.'-'.$periode_bulan);
        

        // gaji pokok harian
        $gph = $karyawan->gaji_pokok/24;
        // gaji berdasarkan kehadiran
        $gbh = $gph*$jml_kehadiran;
        $total_penerimaan = $total_penerimaan + $gbh;

        

        $penerimaan = [
            [
                'kode_komponen'=>'GP',
                'nama_komponen'=>'Gaji Pokok',
                'nilai'=>$karyawan->gaji_pokok
            ],
            [
                'kode_komponen'=>'GPH',
                'nama_komponen'=>'Gaji Pokok Harian',
                'nilai'=>$gph
            ],
            [
                'kode_komponen'=>'GBH',
                'nama_komponen'=>'Gaji Berdasarkan Kehadiran ('.$jml_kehadiran.')',
                'nilai'=>$gbh
            ]
        ];

       

        $potongan = [];


        // =============== KOMPONEN GAJI DETAIL ======================
        $gaji_detail =  \DB::table('gaji_detail')
                        ->join('komponen_gaji','komponen_gaji.kode_komponen','=','gaji_detail.kode_komponen')
                        ->where('gaji_detail.gaji_id',$id)
                        ->get()->toArray();

        foreach($gaji_detail as $gd)
        {
            $komponen_baru = ['kode_komponen'=>$gd->kode_komponen,'nama_komponen'=>$gd->nama_komponen,'nilai'=>$gd->nilai];

            if($gd->jenis=='tunjangan')
            {
                array_push($penerimaan,$komponen_baru);
            }else
            {
                array_push($potongan,$komponen_baru);
            }
        }

        // ============== HITUNG LEMBUR ==============================================
        $hitungLembur = \DB::select("select sum(durasi_lembur) as durasi_lembur 
                            from lembur where left(cast(tanggal_masuk as text),7)='".$periode_tahun.'-'.$periode_bulan."' 
                            and nik='".$gaji->nik."'");
        $upahLembur   = $hitungLembur[0]->durasi_lembur*20000;

        $lembur = ['kode_komponen'=>'LBR','nama_komponen'=>'Upah Lembur','nilai'=>$upahLembur];
        array_push($penerimaan,$lembur);


        $start = 48;
        foreach($penerimaan as $p)
        {
            Fpdf::text(12,$start,$p['kode_komponen']);
            Fpdf::text(24,$start,$p['nama_komponen']);
            Fpdf::text(74,$start,': '.rupiah($p['nilai']));

            if($p['kode_komponen']!='GPH' and $p['kode_komponen']!='GP' and $p['kode_komponen']!='GBH')
            {
                $total_penerimaan += $p['nilai'];
            }

            $start = $start+5;
        }

        //////////////////////////////////////////////////////////////////////

        Fpdf::text(110,40,'Potongan ( -)');
        $start = 48;
        foreach($potongan as $pt)
        {
            //dd($pt);
            Fpdf::text(110,$start,$pt['kode_komponen']);
            Fpdf::text(124,$start,$pt['nama_komponen']);
            Fpdf::text(174,$start,': '.rupiah($pt['nilai']));
            $start = $start+5;
            $total_potongan = $total_potongan+$pt['nilai'];
        }

        Fpdf::text(12,82,'Total Penerimaan');
        Fpdf::text(74,82,': '.rupiah($total_penerimaan));

        Fpdf::text(12,86,'Gaji Yang Diterima');
        Fpdf::text(74,86,': '.(rupiah($total_penerimaan - $total_potongan)));

        Fpdf::text(12,90,'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');


        Fpdf::text(12,96,'Nama Perusahaan');
        Fpdf::text(42,96,' : '.$pengaturan->nama_perusahaan);
        Fpdf::text(12,100,'Periode');
        Fpdf::text(42,100,' : '.$periode_sekarang.' - '.$periode_bln_depan);
        Fpdf::text(12,104,'Departemen');
        Fpdf::text(42,104,' : HRD/ Admin');


        Fpdf::text(12,108,'NIK');
        Fpdf::text(42,108,' : '.$karyawan->nik);
        Fpdf::text(12,112,'Nama Karyawan');
        Fpdf::text(42,112,' : '.$karyawan->nama);
        Fpdf::text(12,116,'Jabatan');
        Fpdf::text(42,116,' : '.$karyawan->nama_jabatan);



        Fpdf::text(120,96,'Diserahkan Oleh');
        Fpdf::text(125,116,'Admin');
        Fpdf::text(110,120,'Tgl Cetak : '.date('d/m/Y : H:i:s'));
        Fpdf::text(160,96,'Diterima Oleh');
        Fpdf::text(163,116,$karyawan->nama);

        Fpdf::Output();
        exit;
    }

    function _pdf($id)
    {
        $data['pengaturan']     = \DB::table('pengaturan')->where('id',1)->first(); 
        
        $data['komponenGaji']   = KomponenGaji::pluck('nama_komponen','kode_komponen');
        $gaji                   = Gaji::find($id);

        $periode                = substr($gaji->periode,0,4).'-'.substr($gaji->periode,4,2);
        $data['gaji']           = $gaji;

        $data['karyawan']       = \DB::table('karyawan')
                                    ->join('jabatan','karyawan.kode_jabatan','=','jabatan.kode_jabatan')
                                    ->where('karyawan.nik',$gaji->nik)
                                    ->first();

        $data['gajiDetail']     = \DB::table('gaji_detail')
                                    ->join('komponen_gaji','komponen_gaji.kode_komponen','=','gaji_detail.kode_komponen')
                                    ->where('gaji_detail.gaji_id',$id)
                                    ->get();

        $data['hitungLembur']   = \DB::select("select sum(durasi_lembur) as durasi_lembur 
                                            from lembur where left(cast(tanggal_masuk as text),7)='".$periode."' 
                                            and nik='".$gaji->nik."'");

        $data['periode']        = $periode;
        $pdf = \PDF::loadView('gaji.invoice', $data);
        return $pdf->stream();
    }


    function templateGaji()
    {
        Fpdf::AddPage('L','A5');
        Fpdf::SetFont('Arial', 'B', 14);
        Fpdf::Cell(190, 7, 'LAPORAN SLIP GAJI KARYAWAN',1,1,'C');
        Fpdf::Cell(190, 16, '',1,1,'C');
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::text(12,22,'Nama Perusahaan');
        Fpdf::text(38,22,' : PT CIPTA KARYA MANDIRI');
        Fpdf::text(12,26,'Periode');
        Fpdf::text(38,26,' : 01/04/2019 - 01/05/2019');
        Fpdf::text(12,30,'Departemen');
        Fpdf::text(38,30,' : HRD/ Admin');


        Fpdf::text(110,22,'NIK');
        Fpdf::text(136,22,' : TI102132');
        Fpdf::text(110,26,'Nama Karyawan');
        Fpdf::text(136,26,' : Nuris Akbar');
        Fpdf::text(110,30,'Jabatan');
        Fpdf::text(136,30,' : HRD/ Admin');

        Fpdf::Cell(190, 90, '',1,1,'C');
        // ---------------------------------------
        Fpdf::text(12,40,'Penerimaan ( +)');
        Fpdf::line(12, 75, 210-20, 75);
        Fpdf::line(12, 42, 110-20, 42);
        Fpdf::line(110, 42, 210-20, 42);

        $penerimaan = [
            'GPH'=>'Gaji Pokok Harian',
            'UK'=>'Uang Kehadiran',
            'UT'=>'Uang Transport / Bensi',
            'UM'=>'Uang Makan',
            'US'=>'Uang Service Motor',
            'UMK'=>'Uang Tunjangan Menikah'
        ];
        $start = 48;
        foreach($penerimaan as $kodeKomponen => $namaKomponen)
        {
            Fpdf::text(12,$start,$kodeKomponen);
            Fpdf::text(24,$start,$namaKomponen);
            Fpdf::text(74,$start,': 40.000');
            $start = $start+5;
        }

        //////////////////////////////////////////////////////////////////////

        Fpdf::text(110,40,'Potongan ( -)');
        $potongan = [
            'PT'=>'Potogan Terlambat',
            'PA'=>'Potongan Absen',
            'PJ'=>'Potongan Jamsostek',
        ];
        $start = 48;
        foreach($potongan as $kodePotongan => $namaPotongan)
        {
            Fpdf::text(110,$start,$kodePotongan);
            Fpdf::text(124,$start,$namaPotongan);
            Fpdf::text(174,$start,': 30.000');
            $start = $start+5;
        }

        Fpdf::text(12,82,'Total Penerimaan');
        Fpdf::text(74,82,': 4.000.000');

        Fpdf::text(12,86,'Gaji Yang Diterima');
        Fpdf::text(74,86,': 4.000.000');

        Fpdf::text(12,90,'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');


        Fpdf::text(12,96,'Nama Perusahaan');
        Fpdf::text(42,96,' : PT CIPTA KARYA MANDIRI');
        Fpdf::text(12,100,'Periode');
        Fpdf::text(42,100,' : 01/04/2019 - 01/05/2019');
        Fpdf::text(12,104,'Departemen');
        Fpdf::text(42,104,' : HRD/ Admin');


        Fpdf::text(12,108,'NIK');
        Fpdf::text(42,108,' : TI102132');
        Fpdf::text(12,112,'Nama Karyawan');
        Fpdf::text(42,112,' : Nuris Akbar');
        Fpdf::text(12,116,'Jabatan');
        Fpdf::text(42,116,' : HRD/ Admin');



        Fpdf::text(120,96,'Diserahkan Oleh');
        Fpdf::text(125,116,'Admin');
        Fpdf::text(110,120,'Tgl Cetak : '.date('d/m/Y : H:i:s'));
        Fpdf::text(160,96,'Diterima Oleh');
        Fpdf::text(163,116,'Nuris Akbar');

        Fpdf::Output();
        exit;
    }
}
