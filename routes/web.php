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

Auth::routes();

//Peminjaman
Route::get('/','HomeController@index');

Route::get('pinjam-ruangan','HomeController@indexruangan');
Route::get('pinjam-ruangan/create-transaksi/{id}','TransaksiController@create');
Route::post('pinjam-ruangan/store_transaksi','TransaksiController@store');

Route::get('pinjam-aset','HomeController@indexaset');
Route::get('pinjam-aset/create-transaksiaset/{id}','TransaksiAsetController@create');
Route::post('pinjam-aset/store_transaksiaset','TransaksiAsetController@store');

//Transaksi-Ruangan
Route::get('transaksi-ruangan/daftar-transaksi','TransaksiController@index');
Route::get('transaksi-ruangan/show-transaksi/{id}','TransaksiController@show');
Route::post('transaksi-ruangan/terima_transaksi/{id}','TransaksiController@terima');
Route::post('transaksi-ruangan/tolak_transaksi/{id}','TransaksiController@tolak');
Route::post('transaksi-ruangan/store_feedback','FeedbackController@store');
Route::post('transaksi-ruangan/transaksi_selesai','AjaxController@transaksiSelesai');

Route::get('transaksi-ruangan/laporan','TransaksiController@laporan');
Route::post('transaksi-ruangan/lap_aksi','TransaksiController@lap_aksi');

Route::resource('transaksi-ruangan-app','RuanganController');

//Transaksi-Aset
Route::get('transaksi-aset/daftar-transaksiaset','TransaksiAsetController@index');
Route::get('transaksi-aset/show-transaksiaset/{id}','TransaksiAsetController@show');
Route::post('transaksi-aset/terima_transaksiaset/{id}','TransaksiAsetController@terima');
Route::post('transaksi-aset/tolak_transaksiaset/{id}','TransaksiAsetController@tolak');
Route::post('transaksi-aset/store_feedbackaset','FeedbackAsetController@store');
Route::post('transaksi-aset/transaksiaset_selesai','AjaxAsetController@transaksiSelesai');

Route::get('transaksi-aset/laporanaset','TransaksiAsetController@laporan');
Route::post('transaksi-aset/lap_aksiaset','TransaksiAsetController@lap_aksi');

Route::resource('transaksi-aset-app','AsetController');




Route::resource('user','UserController');
Route::resource('mahasiswa','MahasiswaController');
Route::resource('manajer','ManajerController');
Route::get('change-password',function(){
    return view('app.change_pass');
});
Route::post('change-password','UserController@change_password');
Route::get('sendwa','WAController@send');
