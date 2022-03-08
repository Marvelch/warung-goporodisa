<?php

namespace App\Http\Controllers;

use App\Profil;
use Auth;
use DB;
use App\Seller;
use App\SellerBank;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getSeller = Seller::all();
        $getBank = SellerBank::where('id_seller',Auth::User()->id)->first();

        return view('profil.index',compact('getSeller','getBank'));
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
     * @param  \App\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function show(Profil $profil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function edit(Profil $profil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profil $profil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profil $profil)
    {
        //
    }

    /**
     * Verification code otp.
     *
     * @param  \App\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function verification(Profil $profil)
    {
        return view('profil.verification');
    }

    public function otp(Request $request,Profil $profil)
    {
        DB::beginTransaction();

        try {
            $getRandom = rand(10000,99999);

            $userkey = 'f716e2ce24d9';
            $passkey = '965c7bbb3c5d03f50c45c78e';
            $telepon =  $request->phone;
            $message = '[RAHASIA] GOPORODISA '.$getRandom.'KONFIRMASI DALAM 30 MENIT';
            $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url);
            curl_setopt($curlHandle, CURLOPT_HEADER, 0);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
            curl_setopt($curlHandle, CURLOPT_POST, 1);
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
                'userkey' => $userkey,
                'passkey' => $passkey,
                'to' => $telepon,
                'message' => $message
            ));
            $results = json_decode(curl_exec($curlHandle), true);
            curl_close($curlHandle);
            
            // Validasi duplikat nomor telepon 
            $getPhone = Seller::select('phone')
                                ->where('phone',$request->phone)
                                ->first();
            
            if($getPhone != null)
            {
                DB::rollback();

                Alert::error('Gagal','Kesalahan Duplikat Data Telepon');
                return back();
            }else{
                Seller::where('id',Auth::User()->id)->update([
                    'phone'             => $request->phone,
                    'otp'               => $getRandom,
                    'phone_verified'    => 0,
                ]);
            }
            
            DB::commit();

            Alert::success('Sukses','Kode OTP berhasil terkirim !');
            return redirect('/halaman_profil/tampilan_verifikasi_otp');
        } catch (\Throwable $th) {

            DB::rollback();

            Alert::error('Gagal','Verifikasi kode OTP bermasalah !');
            return back();

            // return $th->getMessage();
        }
    }

    public function tampilan_verifikasi_otp(Profil $profil)
    {
        $getSellers = Seller::where('id',Auth::User()->id)
                              ->get();   

        return view('profil.otp_verification',compact('getSellers'));
    }

    public function proses_verifikasi_otp(Request $request, Profil $profil)
    {
        $getOTP = Seller::where('id',Auth::User()->id)->get();
        
        DB::beginTransaction();
        
        if($request->otp_code == $getOTP[0]->otp){
            try {
                Seller::where('id',Auth::User()->id)->update([
                            'phone_verified'    => 1,
                ]);

                DB::commit();
                
                Alert::success('Terverifikasi','Selamat no telepon anda telah terverifikasi oleh Tokotorang.');
                return redirect('halaman_profil/profil');
            } catch (\Throwable $th) {
                
                DB::rollback();
                
                Alert::error('Gagal','Verifikasi kode OTP bermasalah !');
                return back();
                // return $th->getMessage();
            }
        }else{
            Alert::error('Gagal','Kode OTP yang digunakan tidak sesuai.');
            return back();
        }
    }

    public function verifikasi_otp_ulang_tampilan(Profil $profil)
    {
        $getSellers = Seller::where('id',Auth::User()->id)->get();
        $getTelepon = $getSellers[0]->phone;

        return view('profil.resend_otp',compact('getTelepon'));
    }

    public function verifikasi_otp_ulang(Request $request,Profil $profil)
    {
        $getSellers = Seller::where('id',Auth::User()->id)->get();
        
        DB::beginTransaction();
        
        if($request->phone == $getSellers[0]->phone)
        {
            try {
                $userkey = 'f716e2ce24d9';
                $passkey = '965c7bbb3c5d03f50c45c78e';
                $telepon =  $request->phone;
                $message = '[RAHASIA] GOPORODISA '.$getSellers[0]->otp.'KONFIRMASI DALAM 30 MENIT';
                $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
                $curlHandle = curl_init();
                curl_setopt($curlHandle, CURLOPT_URL, $url);
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
                curl_setopt($curlHandle, CURLOPT_POST, 1);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
                    'userkey' => $userkey,
                    'passkey' => $passkey,
                    'to' => $telepon,
                    'message' => $message
                ));
                $results = json_decode(curl_exec($curlHandle), true);
                curl_close($curlHandle);

                // pengecekan kondisi kolom otp apabila null maka update menjadi 1

                if($getSellers[0]->total_otp_request == null)
                {
                    Seller::where('id',Auth::User()->id)->update([
                        'total_otp_request'     => 1,
                    ]);
                    
                // }else if($getSellers[0]->total_otp_request == 1){
                //     Seller::where('id',Auth::User()->id)->update([
                //         'total_otp_request'     => 2,
                //     ]);
                // }else if(date('Y-m-d') >= $getSellers[0]->block_otp_time){
                //     Seller::where('id',Auth::User()->id)->update([
                //         'block_otp_time'     => null,
                //     ]);
                }else{
                    $time = date('Y-m-d H:i:s');
                    $date = date_create($time);
                    date_add($date, date_interval_create_from_date_string('1 days'));
                    $postTime = date_format($date, 'Y-m-d H:i:s');

                    Seller::where('id',Auth::User()->id)->update([
                        'total_otp_request'     => 0,
                        'block_otp_time'        => $postTime,
                    ]);
                }
                
                DB::commit();
                
                Alert::success('Sukses','Kode OTP berhasil terkirim !');
                return redirect('/halaman_profil/tampilan_verifikasi_otp');
            } catch (\Throwable $th) {
                DB::rollback();
                
                Alert::error('Gagal','Verifikasi kode OTP bermasalah !');
                // return $th->getMessage();
            }
        }else{
            try {
                $getRandom = rand(10000,99999);
    
                $userkey = 'f716e2ce24d9';
                $passkey = '965c7bbb3c5d03f50c45c78e';
                $telepon =  $request->phone;
                $message = '[RAHASIA] GOPORODISA '.$getSellers[0]->otp.'KONFIRMASI DALAM 30 MENIT';
                $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
                $curlHandle = curl_init();
                curl_setopt($curlHandle, CURLOPT_URL, $url);
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
                curl_setopt($curlHandle, CURLOPT_POST, 1);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
                    'userkey' => $userkey,
                    'passkey' => $passkey,
                    'to' => $telepon,
                    'message' => $message
                ));
                $results = json_decode(curl_exec($curlHandle), true);
                curl_close($curlHandle);
    
                Seller::where('id',Auth::User()->id)->update([
                    'phone'             => $request->phone,
                    'otp'               => $getRandom,
                    'block_otp_time'    => null,
                    'total_otp_request' => 1,
                    'phone_verified'    => 0,
                ]);
                
                DB::commit();
                Alert::success('Sukses','Kode OTP berhasil terkirim !');
                return redirect('/halaman_profil/tampilan_verifikasi_otp');
            } catch (\Throwable $th) {
                DB::rollback();
                Alert::error('Gagal','Nomor telepon telah digunakan !');
                // return $th->getMessage();
            }
        }
    }
}
