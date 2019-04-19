<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    function index()
    {
        $data['pengaturan'] = \DB::table('pengaturan')->where('id',1)->first();
        return view('pengaturan',$data);
    }


    function save(request $request)
    {
        

        if($request->hasFile('logo'))
        {
             // upload foto
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath,$fileName);

            $data  = [
                'nama_perusahaan'   =>  $request->nama_perusahaan,
                'alamat_perusahaan' =>  $request->alamat_perusahaan,
                'email'             =>  $request->email,
                'no_telpon'         =>  $request->no_telpon,
                'logo'             =>  $fileName
            ];
        }else
        {
            $data  = [
                'nama_perusahaan'   =>  $request->nama_perusahaan,
                'alamat_perusahaan' =>  $request->alamat_perusahaan,
                'email'             =>  $request->email,
                'no_telpon'         =>  $request->no_telpon
            ];
        }

        \DB::table('pengaturan')->where('id',1)->update($data);
        return redirect('pengaturan')->with('message','Berhasil Menyimpan Perubahan');
    }
}
