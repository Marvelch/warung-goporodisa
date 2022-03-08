@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Toko</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="m-4">
                                <p>
                                    <h6>Perubahan Data Toko</h6>
                                    <ul>
                                        <li>Perubahan data toko akan berpengaruh pada ongkos kirim. <p>Contoh : lokasi
                                                awal toko lirung, maka pengiriman lirung ke moronge Rp 3.000 per 2 kg
                                                maka dengan update lokasi dari lirung ke musi dan ongkos kirim pun akan
                                                berubah harga menyesuaikan dengan lokasi terbaru yaitu musi ke moronge
                                                Rp 5.000.</li>
                                        <li>Catatan transaksi lama akan mengikuti perubahan data baru. Semua riwayat
                                            transaksi akan tetap tersusun sesuai data lama hanya nama yang akan berubah
                                            mengikuti data baru.
                                </p>
                                </li>
                                <li>Bila terdapat kesalahan pada perubahan data dapat <b><a href="">menghubungi
                                            kami</a></b>.</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 pt-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <form action="{{URL('page_toko/toko/'.$getToko->id)}}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group m-3">
                                            <label for=""><b>Nama Toko</b></label>
                                            <input name="nama_toko" type="text" class="form-control"
                                                value="{{ $getToko->nama_toko }}">
                                        </div>
                                        <div class="form-group m-3">
                                            <label for=""><b>Pilih Kecamatan</b></label>
                                            <select name="id_lokasi" id="" class="form-control">
                                                <option value="{{ $getLokasi->id }}">Terpilih :
                                                    {{ $getLokasi->nama_desa }}
                                                </option>
                                                @foreach($allLokasi as $item)
                                                <option value="{{$item->id}}">
                                                    {{$item->nama_desa}}
                                                    @endforeach
                                                </option>
                                            </select>

                                        </div>
                                        <div class="form-group m-3">
                                            <label for=""><b>Alamat Toko</b></label>
                                            <textarea name="alamat" id="" cols="30" rows="10"
                                                class="form-control">{{ $getToko->alamat }} </textarea>
                                        </div>
                                        <div class="form-group m-3">
                                            <button type="button" class="btn btn-inverse-primary btn-fw"
                                                onclick="window.location='{{URL('/page_toko/toko')}}'">
                                                Kembali
                                            </button>
                                            <!-- <form action="{{ url('page_toko/toko',$getToko->id) }}" method="get"> -->
                                            <button type="submit" class="btn btn-inverse-primary btn-fw">Simpan</button>
                                            <!-- </form> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
