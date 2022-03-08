<?php

namespace App\Http\Controllers;

use App\PenarikanDana;
use App\Transaksi;
use Illuminate\Http\Request;
use App\Riwayat_Transaksi_Seller;
use DB;
use Alert;
use Auth;

class PenarikanDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $penarikanDana = str_replace('.','',$request->jumlah);

       DB::beginTransaction();

       try {
            $authCheck = Auth::attempt(['email' => Auth::User()->email, 'password' => $request->password]);

            $getSaldo = Transaksi::join('riwayat__transaksi__sellers','riwayat__transaksi__sellers.kode_transaksi','=','Transaksis.kode_transaksi')
                                ->where('riwayat__transaksi__sellers.id_seller',Auth::User()->id)
                                ->where('konfirmasi_pelanggan',1)
                                ->orWhere('konfirmasi_pelanggan',2)
                                ->where('status_transaksi',1)
                                ->select('riwayat__transaksi__sellers.total')
                                ->get();

            if(count($getSaldo) >= 1)
            {
                $saldo = 0;
                for($i = 0;$i < count($getSaldo); $i++)
                {
                    $saldo += $getSaldo[$i]->total;
                }
            }else{
                $saldo = 0;
            }

            if($penarikanDana < 10000 AND $penarikanDana > $saldo)
            {
                DB::rollback();

                Alert::error('PENARIKAN GAGAL','PERIKSA KEMBALI JUMLAH PENARIKAN DANA');
                return back();
            }

            if($authCheck == 1){
                $penarikan = str_replace('.', '', $request->jumlah);
                
                $biaya_layanan = $penarikan * 0.08;

                $id = PenarikanDana::select('id')->orderBy('id','desc')->first();

                if($id == null)
                {
                    $kode_unik = "SWD".Auth::User()->id."0".rand(10,99).date('Y');
                }else{
                    $id_con = $id->id + 1;
                    $kode_unik = "SWD".Auth::User()->id.$id_con.rand(10,99).date('Y');
                }
                
                PenarikanDana::create([
                    'kode_unik'         => $kode_unik,
                    'id_seller'         => Auth::User()->id,
                    'total'             => $penarikan,
                    'biaya_layanan'     => $biaya_layanan,
                    'total_diterima'    => $penarikan - $biaya_layanan,
                    'status'            => 1,
                    'tanggal_penarikan' => date('Y-m-d'),
                ]);

                Riwayat_Transaksi_Seller::create([
                    'id_seller'         => Auth::User()->id,
                    'kode_transaksi'    => $kode_unik,
                    'status_transaksi'  => 2,
                    'total'             => $penarikan,
                    'tanggal'           => date('Y-m-d'),
                ]);
            }else{
                DB::rollback();

                Alert::error('PENARIKAN GAGAL','PERIKSA KEMBALI PASSWORD PELANGGAN');
                return back();
            }

            DB::commit();

            Alert::success('PENARIKAN BERHASIL','PENARIKAN DANA BERHASIL DIPROSES');
            return back();
       } catch (\Throwable $th) {

            DB::rollback();

            Alert::error('PENARIKAN GAGAL','PENARIKAN DANA BERMSALAH');
            return back();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PenarikanDana  $penarikanDana
     * @return \Illuminate\Http\Response
     */
    public function show(PenarikanDana $penarikanDana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PenarikanDana  $penarikanDana
     * @return \Illuminate\Http\Response
     */
    public function edit(PenarikanDana $penarikanDana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PenarikanDana  $penarikanDana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenarikanDana $penarikanDana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PenarikanDana  $penarikanDana
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenarikanDana $penarikanDana)
    {
        //
    }
}
