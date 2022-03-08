@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Toko</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center">
                                <img src="{{asset('img/all/location.png')}}" alt="" srcset="" style="width: 70%;">
                            </div>
                        </div>
                        <div class="col-md-6 pt-4">
                            @forelse($getToko as $item)
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="form-group mt-3">
                                        <h4 class="card-title">INFORMASI TOKO</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Nama Toko</td>
                                                    <td>{{ $item->nama_toko }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Desa</td>
                                                    <td>{{ $findLokasi->nama_desa }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat Lengkap</td>
                                                    <td>{{ $item->alamat }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td><label class="badge badge-primary">AKTIF</label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="ml-4 mb-4">
                                    <button type="button" class="btn btn-inverse-primary btn-fw"
                                        onclick="window.location='{{URL('/home')}}'">
                                        Kembali
                                    </button>
                                    <button type="button" class="btn btn-inverse-primary btn-fw"
                                        onclick="window.location='{{ URL ('page_toko/toko/'.$item->id.'/edit')}}'">Ubah
                                        Informasi
                                    </button>
                                </div>

                            </div>
                            @empty
                            <div class="card shadow">
                                <div class="card-body">
                                    <form action="{{url('page_toko/toko')}}" method="post">
                                        @csrf
                                        <div class="form-group m-3">
                                            <label for=""><b>Nama Toko</b></label>
                                            <input name="nama_toko" type="text" class="form-control">
                                        </div>
                                        <div class="form-group m-3">
                                            <label for=""><b>Pilih Kecamatan</b></label>
                                            <select name="id_lokasi" id="" class="form-control">
                                                @foreach($getLokasi as $Lokasi)
                                                <option value="{{ $Lokasi->id }}">
                                                    {{ $Lokasi->nama_desa }}
                                                    @endforeach
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group m-3">
                                            <label for=""><b>Alamat Toko</b></label>
                                            <textarea name="alamat" id="" cols="30" rows="10"
                                                class="form-control"></textarea>
                                        </div>
                                        <div class="form-group m-3">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <!-- Skrip edit button -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
