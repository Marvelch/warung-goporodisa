<?php

namespace App\Http\Controllers;

use App\TransaksiBermasalah;
use App\Transaksi;
use App\Rincian_Transaksi;
use Auth;
use Illuminate\Http\Request;

class TransaksiBermasalahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getLaporan = Rincian_Transaksi::join('transaksis','transaksis.kode_transaksi','=','rincian_transaksis.kode_transaksi')
                                        ->join('transaksi_bermasalahs','transaksi_bermasalahs.kode_transaksi','=','rincian_transaksis.kode_transaksi')
                                        ->where('id_seller',Auth::User()->id)
                                        ->where('status_pesanan',5)
                                        // ->select('transaksi_bermasalahs.*','transaksis.batas_konfirmasi_pesanan')
                                        ->get();

        $repo_arr = [];

        for($i=0;$i<count($getLaporan);$i++)
        {
            $arr = $getLaporan[$i]->kode_transaksi;
            array_push($repo_arr, $arr);
        }

        $remove_duplicate = array_unique($repo_arr);

        $numbering = array_values($remove_duplicate);

        for($i=0;$i<count($numbering);$i++)
        {
            $getTransaksi[] = Transaksi::where('kode_transaksi',$numbering[$i])->get();
        }

        return view('bermasalah.index',compact('getLaporan','getTransaksi'));
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
     * @param  \App\TransaksiBermasalah  $transaksiBermasalah
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiBermasalah $transaksiBermasalah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransaksiBermasalah  $transaksiBermasalah
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiBermasalah $transaksiBermasalah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransaksiBermasalah  $transaksiBermasalah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransaksiBermasalah $transaksiBermasalah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransaksiBermasalah  $transaksiBermasalah
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiBermasalah $transaksiBermasalah)
    {
        //
    }
}
