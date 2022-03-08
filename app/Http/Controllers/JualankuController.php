<?php

namespace App\Http\Controllers;

use App\Jualanku;
use App\Kategori;
use Storage;    
use App\Rincian_Transaksi;
use Auth;
use DB;
use App\Seller;
use App\Toko;
use Validator;
use Crypt;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JualankuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getKategori    = Kategori::all();
        $getToko        = Toko::where('id_seller',Auth::User()->id)->first();
        $getPhone       = Seller::where('id',Auth::User()->id)
                                    ->where('phone_verified',1)
                                    ->first();

        return view('jualanku.index',compact('getKategori','getToko','getPhone'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jualanku()
    {
        $getJualanku    = Jualanku::where('id_seller',Auth::User()->id)
                                    ->orderBy('status','DESC')
                                    ->paginate(15);

        return view('jualanku.list',compact('getJualanku'));
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
            'nama_barang'       => 'required|min:5|max:100',
            'profile_image'     => 'required|mimes:jpeg,jpg,png|max:2048',
            'profile_image1'    => 'required|mimes:jpeg,jpg,png|max:2048',
            'profile_image2'    => 'required|mimes:jpeg,jpg,png|max:2048',
            'profile_image3'    => 'required|mimes:jpeg,jpg,png|max:2048',
            'id_kategori'       => 'required',
            'harga'             => 'required',
            'jumlah'            => 'required|min:1|max:5000|numeric',
            'berat'             => 'required|min:0.1|max:1000|numeric',
            'merek'             => 'required|min:1|max:40',
            'kondisi'           => 'required',
            'deskripsi'         => 'required|min:20|max:1500',
        ],
        [
            'nama_barang.required'      => 'kesalahan kolom nama barang',
            'profile_image.required'    => 'kesalahan kolom gambar utama',
            'profile_image1.required'   => 'kesalahan kolom gambar kiri',
            'profile_image2.required'   => 'kesalahan kolom gambar kanan',
            'profile_image3.required'   => 'kesalahan kolom gambar belakang',
            'id_kategori.required'      => 'kesalahan kolom kategori',
            'harga.required'            => 'kesalahan kolom harga',
            'jumlah.required'           => 'kesalahan kolom jumlah',
            'berat.required'            => 'kesalahan kolom berat',
            'merek.required'            => 'kesalahan kolom merek',
            'kondisi.required'          => 'kesalahan kolom kondisi',
            'deskripsi.required'        => 'kesalahan kolom deskripsi',
        ]);
 
        DB::beginTransaction();
        
        try {
            // Menghilangkan 3 karakter terakhir
            $trimHarga = substr($request->harga, 0, -3);

            $getToko = Toko::where('id_seller',Auth::User()->id)->firstOrFail();

            /*------------------------------------------------------------------
            |
            | Convert file gambar menjadi 400 x 400 dan pengurangan ukuran gambar
            |
            |-------------------------------------------------------------------*/

            /* Tampilan gambar bagian depan */
            $file = $request->file('profile_image');
            $path = $file->hashName('public/images');
            $image = Image::make($file)->fit(400);
            Storage::put($path, (string) $image->encode());
            $trimgmbr_depan     = $path;

            /* Tampilan gambar bagian kiri */
            $file1 = $request->file('profile_image1');
            $path1 = $file1->hashName('public/images');
            $image1 = Image::make($file1)->fit(400);
            Storage::put($path1, (string) $image1->encode());
            $trimgmbr_kiri      = $path1;

            /* Tampilan gambar bagian kanan */
            $file2 = $request->file('profile_image2');
            $path2 = $file2->hashName('public/images');
            $image2 = Image::make($file2)->fit(400);
            Storage::put($path2, (string) $image2->encode());
            $trimgmbr_kanan     = $path2;

            /* Tampilan gambar bagian bawah */
            $file3 = $request->file('profile_image3');
            $path3 = $file3->hashName('public/images');
            $image3 = Image::make($file3)->fit(400);
            Storage::put($path3, (string) $image3->encode());
            $trimgmbr_belakang   = $path3;

            $id = Auth::User()->id;

            Jualanku::create([
                'nama_barang'   => $request->nama_barang,
                'gmbr_depan'    => substr($trimgmbr_depan, 6),
                'gmbr_kiri'     => substr($trimgmbr_kiri, 6),
                'gmbr_kanan'    => substr($trimgmbr_kanan, 6),
                'gmbr_belakang' => substr($trimgmbr_belakang, 6),
                'id_kategori'   => $request->id_kategori,
                'id_seller'     => Auth::User()->id,
                'id_lokasi'     => $getToko->id_lokasi,
                'harga'         => str_replace( array(",", "'", ";"), '', $trimHarga),
                'jumlah'        => $request->jumlah,
                'berat'         => $request->berat,
                'merek'         => $request->merek,
                'kondisi'       => $request->kondisi,
                'deskripsi'     => $request->deskripsi,
            ]);

            DB::commit();

            Alert::success('Sukses','Barang '.$request->nama_barang. ' Berhasil Tersimpan !');
            return back();
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Gagal','Pastikan mengisi data barang dengan benar.');
            return back();
            
            // return $th->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jualanku  $jualanku
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_decrypts = Crypt::decrypt($id);

        $getJualanku    = Jualanku::where('id',$id_decrypts)->firstOrFail();
        $getKategori    = Jualanku::find($id_decrypts)->Kategoris;

        return view('jualanku.show',compact('getJualanku','getKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jualanku  $jualanku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_decrypt = Crypt::decrypt($id);

        $getJualanku    = jualanku::where('id',$id_decrypt)->first();
        $getKategori    = kategori::all();
        $selectKategori = kategori::find($getJualanku->id_kategori);

        return view('jualanku.edit',compact('getJualanku','getKategori','selectKategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jualanku  $jualanku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            // Menghilangkan 3 karakter terakhir
            $trimHarga = substr($request->harga, 0, -3);

            $storageJualanku = Jualanku::where('id',$id)->first();

            if($request->profile_image != NULL){
                $trimgmbr_put_depan     = Storage::putFile('public/images',$request->file('profile_image'),);
                $trimgmbr_depan         = substr($trimgmbr_put_depan, 6);

                // Menghapus file gambar sebelum update 
                $productImage = str_replace('/storage', '', $storageJualanku->gmbr_depan);
                Storage::delete('/public' . $productImage);
            }else{
                $trimgmbr_depan         = $storageJualanku->gmbr_depan;
            }
            
            if($request->profile_image1 != NULL){
                $trimgmbr_put_kiri      = Storage::putFile('public/images',$request->file('profile_image1'),);
                $trimgmbr_kiri          = substr($trimgmbr_put_kiri, 6);
            }else{
                $trimgmbr_kiri          = $storageJualanku->gmbr_kiri;
            }
            
            if($request->profile_image2 != NULL){
                $trimgmbr_put_kanan     = Storage::putFile('public/images',$request->file('profile_image2'),);
                $trimgmbr_kanan         = substr($trimgmbr_put_kanan, 6);
            }else{
                $trimgmbr_kanan         = $storageJualanku->gmbr_kanan;
            } 
            
            if($request->profile_image3 != NULL){
                $trimgmbr_put_belakang  = Storage::putFile('public/images',$request->file('profile_image3'),);
                $trimgmbr_belakang      = substr($trimgmbr_put_belakang, 6);
            }else{
                $trimgmbr_belakang      = $storageJualanku->gmbr_belakang;
            }

            if($request->jumlah > 0)
            {
               $status = 1;
            }else{
                $status = 0;
            }

            Jualanku::where('id',$id)->update([
                'nama_barang'   => $request->nama_barang,
                'gmbr_depan'    => $trimgmbr_depan,
                'gmbr_kiri'     => $trimgmbr_kiri,
                'gmbr_kanan'    => $trimgmbr_kanan,
                'gmbr_belakang' => $trimgmbr_belakang,
                'id_kategori'   => $request->id_kategori,
                'id_seller'     => Auth::User()->id,
                'harga'         => str_replace( array(",", "'", ";"), '', $trimHarga),
                'jumlah'        => $request->jumlah,
                'berat'         => $request->berat,
                'status'        => $status,
                'merek'         => $request->merek,
                'kondisi'       => $request->kondisi,
                'deskripsi'     => $request->deskripsi,
            ]);

            Alert::success('Sukses','Barang '.$request->nama_barang. ' Berhasil Tersimpan !');
            return back();
        } catch (\Throwable $th) {
            // Alert::error('Gagal','Kesalahan penginputan data barang !');
            // return back();
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jualanku  $jualanku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::beginTransaction();

        try {

            // Pengecekan sistem apabila barang sudah terjual hanya bisa update status non aktif
            $getRincianTransaksi = Rincian_Transaksi::where('id_jualanku',$id)->first();

            if(is_null($getRincianTransaksi))
            {
                $getJualanku    = jualanku::where('id',$id)->first();

                $imgDepan       = str_replace('/storage', '', $getJualanku->gmbr_depan);
                Storage::delete('/public' . $imgDepan);
    
                $imgKiri        = str_replace('/storage', '', $getJualanku->gmbr_kiri);
                Storage::delete('/public' . $imgKiri);
    
                $imgKanan       = str_replace('/storage', '', $getJualanku->gmbr_kanan);
                Storage::delete('/public' . $imgKanan);
    
                $imgBelakang    = str_replace('/storage', '', $getJualanku->gmbr_belakang);
                Storage::delete('/public' . $imgBelakang);
    
                $getJualanku->delete();
            }else{
                Jualanku::where('id',$id)->update([
                    'status'    =>  0,
                ]);
            }

            DB::commit();

            Alert::success('Sukses','Barang berhasil dihapus, Silahkan cek kembali barang tersebut !');
            return redirect('/halaman_jualanku/daftar_barang');
        } catch (\Throwable $th) {
            DB::rollback();

            // return $th->getMessage();
            
            Alert::error('Gagal','Kamu mengalami kesalahan pada penghapusan barang / item.');
            return redirect('/halaman_jualanku/daftar_barang');
        }
    }
}
