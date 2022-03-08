<?php

namespace App\Http\Controllers;

use App\Pesanan;
use App\Rincian_transaksi;
use App\Riwayat_Transaksi;
use App\Riwayat_Transaksi_Seller;
use Auth;
use DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use PDF;
use Alert;
use App\Ongkir;
use App\Transaksi;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $getTransaksi[] = Transaksi::join('rincian_transaksis','rincian_transaksis.kode_transaksi','=','transaksis.kode_transaksi')
        //                             ->where('rincian_transaksis.id_seller',Auth::User()->id)
        //                             ->where('transaksis.status_pembayaran',1)
        //                             ->orderBy('rincian_transaksis.id','DESC')
        //                             ->paginate(10);
                                    
        $getRincianTransaksi = Rincian_Transaksi::join('Transaksis','Transaksis.kode_transaksi','Rincian_Transaksis.kode_Transaksi')
                               ->where('rincian_transaksis.id_seller',Auth::User()->id)
                               ->where('status_pembayaran',1)
                               ->select('rincian_transaksis.kode_transaksi')
                               ->groupBy('kode_transaksi')
                               ->orderBy('rincian_transaksis.id','DESC')
                               ->paginate(10);

        for($i=0;$i<count($getRincianTransaksi);$i++)
        {
            $getTransaksi[] = Transaksi::where('kode_transaksi',$getRincianTransaksi[$i]->kode_transaksi)
                                        ->select('kode_transaksi','status_pembayaran','status_pesanan','total_harga_barang','tanggal_transaksi','batas_waktu_pengiriman','status_pesanan') 
                                        ->get();
        }

        // return $getTransaksi;
        return view('pesanan.index',compact('getTransaksi','getRincianTransaksi'));
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
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getTransaksi = Transaksi::join('rincian_transaksis','rincian_transaksis.kode_transaksi','=','transaksis.kode_transaksi')
                                    ->join('jualankus','jualankus.id','=','rincian_transaksis.id_jualanku')
                                    ->where('rincian_transaksis.id_seller',Auth::User()->id)
                                    ->where('transaksis.kode_transaksi',$id)
                                    ->where('transaksis.status_pembayaran',1)
                                    ->select('rincian_transaksis.*','transaksis.status_pesanan','jualankus.nama_barang','transaksis.ketegori_pengiriman','transaksis.batas_waktu_pengiriman','rincian_transaksis.status_pesanan_per_transaksi','konfirmasi_pelanggan')
                                    ->paginate(10);
                                    // ->get();

        return view('pesanan.detail',compact('getTransaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }

    /**
     * Print pdf file
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $getTransaksi = Transaksi::join('rincian_transaksis','rincian_transaksis.kode_transaksi','=','transaksis.kode_transaksi')
                                ->join('jualankus','jualankus.id','=','rincian_transaksis.id_jualanku')
                                ->where('rincian_transaksis.id_seller',Auth::User()->id)
                                ->where('transaksis.status_pembayaran',1)->firstOrFail();

        // return $getTransaksi;
        $pdf = PDF::loadview('pesanan.pdf',['getTransaksi'=>$getTransaksi]);
        return $pdf->stream();
    }

    /**
     * Update status pesanan
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function getStatusTerima(Request $request, $id)
    {
        /* Mengambil data dari tabel rincian transaksi */
        $rincianTransaksi = Rincian_Transaksi::where('kode_transaksi',$id)
                                              ->where('id_seller',Auth::User()->id)
                                              ->select('jumlah_pesanan','id')
                                              ->get();

        /* Menghitung total rincian transaksi */
        $jumlahRincianTransaksi = count($rincianTransaksi);

        /* Mengambil data transaksi pengecekan status pesanan */
        $getTransaksi = Transaksi::where('kode_transaksi',$id)
                                   ->select('status_pesanan','id_user')
                                   ->first();

        $countRincianTransaksi = Rincian_Transaksi::where('kode_transaksi',$id)
                                                    ->select('ket_stok')
                                                    ->get();
        DB::beginTransaction();

        try {   
            /* Pengecekan status transaksi */
            if($getTransaksi->status_pesanan == 4)
            {
                Alert::info('PEMBAHARUAN','TRANSAKSI DIBATALKAN OLEH PELANGGAN');
                return back();
            }else{
                for($i=0;$i < $jumlahRincianTransaksi; $i++)
                {
                    /* Pengecekan kode transaksi*/
                    $getTransaksiCheck = Transaksi::where('kode_transaksi',$id)
                                                    ->select('kode_transaksi')
                                                    ->first();

                    /* Handling kesalahan transaksi */
                    if(is_null($getTransaksiCheck)){
                        DB::rollback();
                        return redirect('page_pesanan/kesalahan_transaksi');
                    }else{
                        /* Update status per transaksi pada table rincian transaksi */
                        Rincian_transaksi::where('kode_transaksi',$id)
                                ->where('id',$rincianTransaksi[$i]->id)
                                ->update([
                                    'status_pesanan_per_transaksi' => 0,
                                    'ket_stok'                     => $request->ket_stok[$i],
                                ]);
                    }
                }
                
                for($i = 0; $i < count($request->ket_stok); $i++)
                {
                    $getRincinTransaksi = Rincian_Transaksi::join('tokos','tokos.id','rincian_transaksis.id_toko')
                                                            ->join('alamats','alamats.id','rincian_transaksis.id_alamat_penerima')
                                                            ->select('harga_barang','rincian_transaksis.id_seller','tokos.id_lokasi as id_lokasi_toko','alamats.id_lokasi')
                                                            ->where('rincian_transaksis.id',$rincianTransaksi[$i]->id)
                                                            ->where('kode_transaksi',$id)
                                                            ->get();

                    /* Menghitung Pengiriman */
                    $getHitung = Ongkir::where('id_lokasi_awal',$getRincinTransaksi[0]->id_lokasi_toko)
                                        ->where('id_lokasi_akhir',$getRincinTransaksi[0]->id_lokasi)
                                        ->first();

                    $getRiwayatTransaksi = Riwayat_Transaksi_Seller::where('id_rincian_transaksi',$rincianTransaksi[$i]->id)
                                                                    ->where('kode_transaksi',$id)
                                                                    ->get();

                    /* Inisialisasi karena request->ket_stok tidak terbaca dalam IF ELSE */

                    $array_ket_stok = $request->ket_stok[$i];

                    if(count($getRiwayatTransaksi) > 0)
                    {
                        DB::rollback();

                        /* Handle kesalahan bila transaksi sudah dilakukan sebelumnya */
                        Alert::error('Transaksi Gagal','Transaksi Gagal Bisa Diproses Kesalahan');
                        return redirect('/page_pesanan/pesanan/'.$id);
                    }else{
                        if($array_ket_stok[0] == 1){
                            /* Mencatata riwayat transaksi dari penjual */
                            Riwayat_Transaksi_Seller::create([
                                'id_seller'            => $getRincinTransaksi[0]->id_seller,
                                'id_rincian_transaksi' => $rincianTransaksi[$i]->id,
                                'kode_transaksi'       => $id,
                                'total'                => $getRincinTransaksi[0]->harga_barang * $rincianTransaksi[$i]->jumlah_pesanan,
                                'status_transaksi'     => 1,
                                'tanggal'              => date('Y-m-d'),
                            ]);
                        }else{
                            Riwayat_Transaksi::create([
                                'id_user'              => $getTransaksi->id_user,
                                'id_rincian_transaksi' => $rincianTransaksi[$i]->id,
                                'kode_transaksi'       => $id,
                                'total'                => $getHitung->tarif + ($getRincinTransaksi[0]->harga_barang * $rincianTransaksi[$i]->jumlah_pesanan),
                                'status_transaksi'     => 1,
                                'tanggal'              => date('Y-m-d'),
                            ]);
                        }
                    } 
                }

                $getCheck = Rincian_transaksi::where('kode_transaksi',$id)
                                                ->where('ket_stok',2)
                                                ->get();

                if(count($countRincianTransaksi) == count($getCheck))
                {
                     /* Transaksi Dibatalkan Karena Stok Barang Semua Kosong */
                    Transaksi::where('kode_transaksi',$id)->update([
                        'status_pesanan'  =>  4,
                    ]);
                }else{
                    /* Update Transaksi Diproses Oleh Toko */
                    Transaksi::where('kode_transaksi',$id)->update([
                        'status_pesanan'  =>  1,
                    ]);
                }
               
            }

            DB::commit();
            Alert::success('PESANAN DITERIMA','PAKET BERHASIL DITERIMA DAN PROSES');
            return redirect('/page_pesanan/pesanan/'.$id);
        } catch (\Throwable $th) {
            DB::rollback();

            // Alert::error('Transaksi Bermasalah','Transaksi Berhasil Diterima, Periksa Kembali.');
            // return redirect('/page_pesanan/pesanan/'.$id);
            
            return $th->getMessage();
            
        }
    }

    /**
     * Update status pesanan
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function error_page()
    {
        return view('pesanan.error');
    }

    /**
     * Update status pesanan
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function StatusPesananTolak($kode_transaksi)
    {
        DB::beginTransaction();

        try {     
            /* Mengambil data dari tabel rincian transaksi */
            $rincianTransaksi = Rincian_Transaksi::where('kode_transaksi',$kode_transaksi)
                                                 ->where('id_seller',Auth::User()->id)
                                                 ->select('jumlah_pesanan','id')
                                                 ->get();

            /* Menghitung total rincian transaksi */
            $jumlahRincianTransaksi = count($rincianTransaksi);

            for($i=0; $i < $jumlahRincianTransaksi; $i++)
            {
                /* Membatalkan transaksi pada table rincian transaksi */
                Rincian_transaksi::where('kode_transaksi',$kode_transaksi)
                        ->where('id',$rincianTransaksi[$i]->id)
                        ->update([
                            'status_pesanan_per_transaksi' => 2,
                        ]);
            }
            
            /* Mengambil jumlah transaksi dari tabel rincian transaksi */
            $getCheck =  Rincian_transaksi::where('kode_transaksi',$kode_transaksi)
                                        ->get();

            $cekProses = Rincian_transaksi::where('kode_transaksi',$kode_transaksi)
                                        ->where('status_pesanan_per_transaksi',0)
                                        ->get();
            
            $cekSelesai = Rincian_transaksi::where('kode_transaksi',$kode_transaksi)
                                        ->where('status_pesanan_per_transaksi',1)
                                        ->get();

            $cekBatal = Rincian_transaksi::where('kode_transaksi',$kode_transaksi)
                                            ->where('status_pesanan_per_transaksi',2)
                                            ->get();
            
            /* Update status pesanan pada table transaksi */
            if(count($getCheck) == count($cekProses))
            {
                Transaksi::where('kode_transaksi',$kode_transaksi)
                                    ->update([
                                        'status_pesanan' => 1,
                                    ]);
            }elseif(count($getCheck) == count($cekSelesai))
            {
                Transaksi::where('kode_transaksi',$kode_transaksi)
                                    ->update([
                                        'status_pesanan' => 2,
                                    ]);
            }elseif(count($getCheck) == count($cekBatal))
            {
                Transaksi::where('kode_transaksi',$kode_transaksi)
                                    ->update([
                                        'status_pesanan' => 4,
                                    ]);
            }else{
                Transaksi::where('kode_transaksi',$kode_transaksi)
                                    ->update([
                                        'status_pesanan' => 3,
                                    ]);
            }
            
            // Cek Metode Pembayaran 
            $metodePembayaran = Transaksi::where('kode_transaksi',$kode_transaksi)->first();

            if($metodePembayaran->metode_pembayaran == 1)
            {
                for($i = 0; $i < $jumlahRincianTransaksi; $i++)
                {
                    $getRincinTransaksi = Rincian_Transaksi::select('harga_barang','jumlah_pesanan')
                                                            ->where('id',$rincianTransaksi[$i]->id)
                                                            ->where('kode_transaksi',$kode_transaksi)
                                                            ->get();
                    
                    $getTransaksi = Transaksi::select('id_user')
                                            ->where('kode_transaksi',$kode_transaksi)
                                            ->get();
                    
                    Riwayat_Transaksi::create([
                        'id_user'              => $getTransaksi[0]->id_user,
                        'id_rincian_transaksi' => $rincianTransaksi[$i]->id,
                        'kode_transaksi'       => $kode_transaksi,
                        'total'                => $getRincinTransaksi[$i]->harga_barang * $getRincinTransaksi[$i]->jumlah_pesanan,
                        'status_transaksi'     => 1,
                        'tanggal'              => date('Y-m-d'),
                    ]);
                }
            }else{
                // Pengelolaan Dana COD - Tanpa Pengembalian Biaya

                for($i = 0; $i < $jumlahRincianTransaksi; $i++)
                {   
                    $getRincinTransaksi = Rincian_Transaksi::select('harga_barang')
                                        ->where('id',$rincianTransaksi[$i]->id)
                                        ->where('kode_transaksi',$kode_transaksi)
                                        ->get();
                    
                    $getTransaksi = Transaksi::select('id_user')
                                            ->where('kode_transaksi',$kode_transaksi)
                                            ->get();

                    // Mengecek transaksi sudah tercatat pada riwayat transaksi atau belum 

                    $getRiwayatTransaksi = Riwayat_Transaksi::where('id_rincian_transaksi',$rincianTransaksi[$i]->id)
                                                            ->where('kode_transaksi',$kode_transaksi)
                                                            ->first();
                    
                    if(is_null($getRiwayatTransaksi))
                    {
                        Riwayat_Transaksi::create([
                            'id_user'              => $getTransaksi[0]->id_user,
                            'id_rincian_transaksi' => $rincianTransaksi[$i]->id,
                            'kode_transaksi'       => $kode_transaksi,
                            'total'                => 0,
                            'status_transaksi'     => 1,
                            'tanggal'              => date('Y-m-d'),
                        ]);
                    }else{
                        DB::rollback();

                        Alert::error('Transaksi Gagal','Transaksi Bermasalah Tolong Periksa Kembali');
                        return redirect('/page_pesanan/pesanan/'.$kode_transaksi);
                    }   
                }
            }
            
            DB::commit();

            Alert::success('Transaksi Berhasil','Transaksi Bermasalah Periksa Kembali.');
            return redirect('/page_pesanan/pesanan/'.$kode_transaksi);
            // return URL('/page_pesanan/pesanan/'.$kode_transaksi);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
            
        }
    }
    
}
