@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Rekening Bank</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5><i class="fas fa-university mr-2"></i> REKENING BANK</h5>
                                <hr>
                            </div>
                            <form action="{{URL('page_bank/bank/'.$getSellerBank->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Lengkap <i>(Pemilik Rekening)</i></label>
                                    <input name="nama_pemilik_rekening" type="text" class="form-control"
                                        value="{{$getSellerBank->nama_pemilik_rekening}}">
                                    @error('nama_pemilik_rekening')
                                    <small>
                                        <p class="text-danger pt-1">* {{ $message }}</p>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">No Rekening</label>
                                    <input name="nomor_rekening" type="text" class="form-control"
                                        value="{{$getSellerBank->nomor_rekening}}">
                                    @error('nomor_rekening')
                                    <small>
                                        <p class="text-danger pt-1">* {{ $message }}</p>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Pilih Rekening</label>
                                    <select name="id_bank" id="" class="form-control">
                                        <option value="{{$getSellerBank->id}}">Terpilih : {{$getSellerBank->Banks->nama_bank}} 	&#10004;</option>
                                        @foreach($getBank as $item)
                                        <option value="{{$item->id}}">{{$item->nama_bank}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_bank')
                                    <small>
                                        <p class="text-danger pt-1">* {{ $message }}</p>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <a href="{{URL('halaman_profil/profil')}}" class="btn btn-primary">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>INFORMASI</h5>
                                <hr>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p>Gunakan rekening bank yang masih dalam keadaan aktif, karena rekening bank
                                            akan digunakan untuk semua transaksi. </p>
                                        <footer class="blockquote-footer"><i><small>Baca Syarat & Ketentuan</small></i>
                                            <footer>
                                    </blockquote>
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
