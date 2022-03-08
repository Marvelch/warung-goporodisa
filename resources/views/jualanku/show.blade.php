@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Jualanku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Barang</li>
                </ol>
            </nav>
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <!-- kosong -->
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3 pt-2">
                                    <div id="thumb-output" class="mb-3"></div>
                                    <div class="form-group">
                                        <label for=""><small>Tampilan Utama</small></label>
                                        <div class="form-group">
                                            <img src="{{asset('storage'.$getJualanku->gmbr_depan)}}" id="preview_img"
                                                class="img-thumbnail m  b-1" style="width: 100%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <div id="thumb-output" class="mb-3"></div>
                                    <div class="form-group">
                                        <label for=""><small>Tampilan Kiri</small></label>
                                        <div class="form-group">
                                            <img src="{{asset('storage'.$getJualanku->gmbr_kiri)}}" id="preview_img1"
                                                class="img-thumbnail mb-1" style="width: 100%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <div id="thumb-output" class="mb-3"></div>
                                    <div class="form-group">
                                        <label for=""><small>Tampilan Kanan</small></label>
                                        <div class="form-group">
                                            <img src="{{asset('storage/images'.$getJualanku->gmbr_kanan)}}"
                                                id="preview_img2" class="img-thumbnail mb-1" style="width: 310px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <div id="thumb-output" class="mb-3"></div>
                                    <div class="form-group">
                                        <label for=""><small>Tampilan Belakang</small></label>
                                        <div class="form-group">
                                            <img src="{{asset('storage'.$getJualanku->gmbr_belakang)}}"
                                                id="preview_img3" class="img-thumbnail mb-1" style="width: 310px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Informasi Barang Jualanku</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <td>
                                                                    Nama Barang
                                                                </td>
                                                                <td>
                                                                    {{$getJualanku->nama_barang}}
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    Kategori
                                                                </td>
                                                                <td>
                                                                    {{$getKategori->kategori}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Harga
                                                                </td>
                                                                <td>
                                                                    <?php echo "Rp " . number_format($getJualanku->harga, 0, ",", "."); ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Jumlah
                                                                </td>
                                                                <td>
                                                                    {{$getJualanku->jumlah}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Kondisi
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                            if($getJualanku->kondisi == 1){
                                                                                echo "Baru";
                                                                            }else{
                                                                                echo "Bekas";
                                                                            }
                                                                        ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Berat
                                                                </td>
                                                                <td>
                                                                    {{$getJualanku->berat}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Merek
                                                                </td>
                                                                <td>
                                                                    {{$getJualanku->merek}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Deskripsi
                                                                </td>
                                                                <td>
                                                                    {{$getJualanku->deskripsi}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-2 pb-5 pl-5">
                                    <div class="form-group">
                                        <?php
                                            $id = Crypt::encrypt($getJualanku->id);
                                        ?>
                                        <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{URL('halaman_jualanku/jualanku/'.$id.'/edit')}}'">
                                            <i class="ti-marker-alt btn-icon-prepend"></i>
                                            Ubah
                                        </button>
                                        <button type="button" class="btn btn-danger btn-icon-text" data-toggle="modal"
                                            data-target="#exampleModal" title="Hapus">
                                            <i class="ti-trash btn-icon-prepend"></i>
                                            Hapus
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <!-- kosong -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Konfirmasi untuk menghapus atau menonaktifkan barang
                    <b>{{$getJualanku->nama_barang}}</b> dari barang jualanku ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{url('halaman_jualanku/jualanku/'.$getJualanku->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-primary">Hapus / Non Aktifkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
