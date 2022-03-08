<?php

namespace App\Http\Controllers;

use App\Saldo;
use Auth;
use App\SellerBank;
use App\Transaksi;
use App\Riwayat_Transaksi_Seller;

use Illuminate\Http\Request;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getBank = SellerBank::where('id_seller',Auth::User()->id)->get();

        // Mencari data riwayat transaksi seller yang sudah dikonfirmasi oleh pelanggan atau mesin 
        $getSaldo = Transaksi::join('riwayat__transaksi__sellers','riwayat__transaksi__sellers.kode_transaksi','=','Transaksis.kode_transaksi')
                                ->where('riwayat__transaksi__sellers.id_seller',Auth::User()->id)
                                ->where('konfirmasi_pelanggan',1)
                                ->orWhere('konfirmasi_pelanggan',2)
                                ->where('status_transaksi',1)
                                ->select('riwayat__transaksi__sellers.total')
                                ->get();

        $getPenarikan = Riwayat_Transaksi_Seller::select('total')
                                            ->where('status_transaksi',2)
                                            ->where('id_seller',Auth::User()->id)
                                            ->get();

        if(count($getPenarikan) >= 1)
        {
            $saldo_kurang = 0;
            for($i = 0;$i < count($getPenarikan); $i++)
            {
                $saldo_kurang += $getPenarikan[$i]->total;
            }
        }else{
            $saldo_kurang = 0;
        }

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

        $fix_saldo = $saldo - $saldo_kurang;

        return view('saldo.index',compact('getBank','fix_saldo'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function show(Saldo $saldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function edit(Saldo $saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saldo $saldo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saldo $saldo)
    {
        //
    }

    /**
     * Laporan transaksi.
     *
     * @param  \App\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function riwayat_transaksi(Saldo $saldo)
    {
        $getRiwayatTransaksi = Riwayat_Transaksi_Seller::where('id_seller',Auth::User()->id)
                                                        ->orderBy('id','DESC')
                                                        ->paginate(10);

        return view('saldo.transaction_history',compact('getRiwayatTransaksi'));
    }
}
