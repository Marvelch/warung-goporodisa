<?php

namespace App\Http\Controllers;

use App\Toko;
use App\Jualanku;
use Auth;
use App\Seller;
use App\Lokasi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getLokasi      = Lokasi::all();

        $checkData      = Toko::where('id_seller',Auth::User()->id)->get();

        $getToko        = Toko::where('id_seller',Auth::User()->id)->get();

        if(count($getToko) >= 1)
        {
            $findLokasi     = Toko::where('id_seller',Auth::User()->id)->firstOrFail()->Lokasis; 
        }else{
            $findLokasi = array();
        }

        return view('toko.index',compact('getLokasi','getToko','findLokasi'));
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
        try {
            Toko::create([
                'id_seller'     => Auth::user()->id,
                'id_lokasi'     => $request->id_lokasi,
                'nama_toko'     => $request->nama_toko,
                'alamat'        => $request->alamat,
            ]);

            Alert::success('Sukses','Terima kasih. Pembuatan Toko Berhasil !');
            return back();
        } catch (\Throwable $th) {
            echo $th->getMessage(); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function show(toko $toko)
    {   
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function edit(toko $toko)
    {
        $getLokasi      = Toko::where('id_seller',Auth::User()->id)->firstOrFail()->Lokasis;
        $getToko        = Toko::where('id_seller',Auth::User()->id)->firstOrFail();
        $allLokasi      = Lokasi::all();

        return view('toko.edit',compact('getToko','getLokasi','allLokasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Toko::where('id',$id)->update([
                'nama_toko'  => $request->nama_toko,
                'alamat'     => $request->alamat,
                'id_lokasi'  => $request->id_lokasi,
            ]);

            Jualanku::where('id_seller',Auth::User()->id)
                    ->update(['id_lokasi' => $request->id_lokasi]);

            Alert::success('BERHASIL','Data Toko Berhasil Diperbarui');
            return back();
        } catch (\Throwable $th) {
            Alert::error('Gagal','Perubahaan Data Bermasalah !');
            return back();

            // return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function destroy(toko $toko)
    {
        //
    }
}
