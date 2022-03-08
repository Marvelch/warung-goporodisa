<?php

namespace App\Http\Controllers;

use App\SellerBank;
use App\Bank;
use Alert;
use Auth;
use Crypt;
use DB;
use Illuminate\Http\Request;

class SellerBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getBank = Bank::all();

        return view('bank.index',compact('getBank'));
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
        $this->validate($request,
        [
            'nama_pemilik_rekening' => 'required|min:2|max:150',
            'nomor_rekening'        => 'required|numeric|digits_between:10,20',
            'id_bank'               => 'required',
        ],
        [
            'nama_pemilik_rekening.required'    => 'Perhatikan penginputan / kesalahan pengisian',
            'nomor_rekening.required'           => 'Perhatikan penginputan / kesalahan pengisian',
            'id_bank.required'                  => 'Perhatikan penginputan / kesalahan pengisian',
        ]);

        DB::beginTransaction();

        try {
            /* Pengecekan duplikat data rekening bank */
            $getBank = SellerBank::where('id_seller',Auth::User()->id)->first();

            if(is_null($getBank))
            {
                SellerBank::create([
                    'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
                    'nomor_rekening'        => $request->nomor_rekening,
                    'id_bank'               => $request->id_bank,
                    'id_seller'             => Auth::User()->id,
                ]);
            }else{
                DB::rollback();

                return redirect('page_pesanan/kesalahan_transaksi');
            }
            
            DB::commit();

            Alert::success('Rekening Bank','Rekening Bank Sudah Tersimpan');
            return redirect('/halaman_profil/profil');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            Alert::error('Rekening Bank','Pendaftaran Rekening Bank Bermasalah');
            return redirect('/halaman_profil/profil');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SellerBank  $sellerBank
     * @return \Illuminate\Http\Response
     */
    public function show(SellerBank $sellerBank, $id)
    {
        $id_decrypt = Crypt::decrypt($id);

        $getSellerBank = SellerBank::where('id',$id_decrypt)->first();
        $getBank = Bank::all();

        return view('bank.edit',compact('getSellerBank','getBank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SellerBank  $sellerBank
     * @return \Illuminate\Http\Response
     */
    public function edit(SellerBank $sellerBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SellerBank  $sellerBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'nama_pemilik_rekening' => 'required|min:2|max:100',
            'nomor_rekening'        => 'required|numeric|digits_between:10,20',
            'id_bank'               => 'required',
        ],
        [
            'nama_pemilik_rekening.required'    => 'Perhatikan penginputan / kesalahan pengisian',
            'nomor_rekening.required'           => 'Perhatikan penginputan / kesalahan pengisian',
            'id_bank.required'                  => 'Perhatikan penginputan / kesalahan pengisian',
        ]);

        try {
            SellerBank::where('id',$id)->update([
                'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
                'nomor_rekening'        => $request->nomor_rekening,
                'id_bank'               => $request->id_bank,
                'id_seller'             => Auth::User()->id,
            ]);
            
            Alert::success('Rekening Bank','Pembaharuan Data Rekening Bank Berhasil');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SellerBank  $sellerBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(SellerBank $sellerBank)
    {
        //
    }
}
