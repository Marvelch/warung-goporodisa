<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {

    // Route Toko 
    Route::group(['prefix'=>'page_toko'], function() {
        Route::resource('toko','TokoController');
    });

    // Route Saldo 
    Route::group(['prefix'=>'page_saldo'], function() {
        Route::resource('saldo','SaldoController');
        Route::get('riwayat_transaksi','SaldoController@riwayat_transaksi');
    });

    Route::group(['prefix'=>'halaman_jualanku'], function() {
        Route::resource('jualanku','JualankuController');
        Route::get('daftar_barang','JualankuController@jualanku');
    });

    Route::group(['prefix'=>'halaman_profil'], function() {
        Route::resource('profil','ProfilController');
        Route::get('verification','ProfilController@verification');
        Route::post('otp','ProfilController@otp');
        Route::get('tampilan_verifikasi_otp','ProfilController@tampilan_verifikasi_otp');
        Route::post('proses_verifikasi_otp','ProfilController@proses_verifikasi_otp');
        Route::post('verifikasi_otp_ulang','ProfilController@verifikasi_otp_ulang');
        Route::get('verifikasi_otp_ulang_tampilan','ProfilController@verifikasi_otp_ulang_tampilan');
        Route::get('ubah_profile/{id}','ProfilController@show');
    });

    Route::group(['prefix'=>'page_pesanan'], function() {
        Route::resource('pesanan','PesananController');
        Route::get('pdf/{id}','PesananController@pdf');
        Route::post('terima_pesanan/{id}','PesananController@getStatusTerima');
        Route::get('tolak_pesanan/{kode_transaksi}','PesananController@StatusPesananTolak');
        Route::get('kesalahan_transaksi','PesananController@error_page');
    });

    Route::group(['prefix'=>'page_bank'], function() {
        Route::resource('bank','SellerBankController');
    });

    Route::group(['prefix'=>'page_penarikan_dana'], function() {
        Route::resource('penarikan_dana','PenarikanDanaController');
    });

    Route::group(['prefix'=>'page_bermasalah'], function() {
        Route::resource('transaksi_bermasalah','TransaksiBermasalahController');
    });
});