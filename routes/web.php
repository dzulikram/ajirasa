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

Route::get('/','HomeController@index');
Route::get('daftar-transaksi','TransaksiController@index');
Route::get('laporan','TransaksiController@laporan');
Route::get('create-transaksi/{id}','TransaksiController@create');
Route::get('show-transaksi/{id}','TransaksiController@show');
Route::post('store_transaksi','TransaksiController@store');
Route::post('lap_aksi','TransaksiController@lap_aksi');
Route::post('terima_transaksi/{id}','TransaksiController@terima');
Route::post('tolak_transaksi/{id}','TransaksiController@tolak');
Route::post('transaksi_selesai','AjaxController@transaksiSelesai');

Route::get('/asetdash','HomeController@indexaset');
Route::get('daftar-transaksiaset','TransaksiAsetController@index');
Route::get('laporanaset','TransaksiAsetController@laporan');
Route::get('create-transaksiaset/{id}','TransaksiAsetController@create');
Route::get('show-transaksiaset/{id}','TransaksiAsetController@show');
Route::post('store_transaksiaset','TransaksiAsetController@store');
Route::post('lap_aksiaset','TransaksiAsetController@lap_aksi');
Route::post('terima_transaksiaset/{id}','TransaksiAsetController@terima');
Route::post('tolak_transaksiaset/{id}','TransaksiAsetController@tolak');
Route::post('transaksiaset_selesai','AjaxAsetController@transaksiSelesai');

Route::resource('ruangan','RuanganController');
Route::resource('aset','AsetController');

Route::post('store_feedback','FeedbackController@store');
Route::post('store_feedbackaset','FeedbackAsetController@store');

Route::resource('user','UserController');
Route::resource('mahasiswa','MahasiswaController');
Route::resource('manajer','ManajerController');
Route::get('change-password',function(){
    return view('app.change_pass');
});
Route::post('change-password','UserController@change_password');
