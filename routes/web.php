<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('tes-template',function()
{
    return view('karyawan.index');
});
// routing untuk API
Route::post('kehadiran/api','ApiController@kehadiran');

Route::get('pengaturan','SettingController@index');
Route::post('pengaturan','SettingController@save');

Route::get('kelompokkerja/{id}/polakerja','KelompokKerjaController@polaKerja');
Route::post('simpan-pola-kerja-kelompok-karyawan','KelompokKerjaController@simpanPolaKerja');
Route::delete('hapus-pola-kerja-kelompok-karyawan/{id}','KelompokKerjaController@hapusPolaKerja');
Route::post('tambah-kelompok-kerja','KelompokKerjaController@tambahAnggota');
Route::resource('kelompokkerja','KelompokKerjaController');

Route::post('tambah-anggota-polakerja','PolaKerjaController@tambahAnggota');
Route::delete('hapus-anggota-kelompok-kerja/{id}','KelompokKerjaController@hapusAnggota');
Route::resource('polakerja','PolaKerjaController');
Route::Resource('departemen','DepartemenController');
Route::Resource('jabatan','JabatanController');
Route::get('/karyawan/{nik}/kehadiran','KaryawanController@kehadiran');
Route::get('/karyawan/{nik}/polakerja','KaryawanController@polaKerja');
Route::get('/karyawan/{nik}/lembur','KaryawanController@lembur');
Route::Resource('karyawan','KaryawanController');
Route::Resource('kalenderkerja','KalenderKerjaController');
Route::get('kehadiran','KehadiranController@index');
Route::get('kehadiran/create','KehadiranController@create');
Route::post('export-laporan-kehadiran-excel','KehadiranController@excel');
Route::post('upload-excel-kehadiran','KehadiranController@import');
Route::post('kehadiran','KehadiranController@store');
Route::post('ubah-periode-kehadiran','KehadiranController@ubahPeriodeKehadiran');
Route::get('lembur','LemburController@index');
Route::get('lembur/create','LemburController@create');
Route::post('lembur','LemburController@store');
Route::post('ubah-periode-lembur','LemburController@ubahPeriodeLembur');
Route::delete('hapus-riwayat-lembur/{id}/{url}','LemburController@destroy');

Route::resource('komponengaji','KomponenGajiController');
Route::resource('gaji','GajiController');
Route::resource('kelompokgaji','KelompokGajiController');
Route::post('tambah-komponen-gaji','KelompokGajiController@tambahKomponen');
Route::delete('hapus-komponen-gaji/{id}','KelompokGajiController@hapusKomponen');
Route::post('ubah-periode-gaji','GajiController@ubahPeriodeGaji');
Route::post('tambah-komponen-gaji-detail','GajiController@tambahKomponenDetail');
Route::delete('hapus-komponen-gaji-detail/{id}','GajiController@hapusKomponengajiDetail');
Route::get('gaji/{id}/pdf','GajiController@pdf');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('template-gaji','GajiController@templateGaji');


