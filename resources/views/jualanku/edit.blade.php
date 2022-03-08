@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Jualanku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Informasi Barang</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <!-- kosong -->
                        </div>
                        <div class="col-md-10">
                            <form action="{{url('halaman_jualanku/jualanku/'.$getJualanku->id)}}" method="post"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 pt-2">
                                        <div id="thumb-output" class="mb-3"></div>
                                        <div class="form-group">
                                            <label for=""><small>Tampilan Utama</small></label>
                                            <div class="form-group">
                                                <img src="{{asset('storage'.$getJualanku->gmbr_depan)}}"
                                                    id="preview_img" class="img-thumbnail m  b-1" style="width: 100%;">
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="profile_image" class="custom-file-input"
                                                    id="profile_image" onchange="loadPreview(this);" accept="image/*">
                                                <label class="custom-file-label" for="customFile">Pilih</label>
                                            </div>
                                            @error('profile_image')
                                            <small>
                                                <p class="text-danger pt-1">* {{ $message }}</p>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 pt-2">
                                        <div id="thumb-output" class="mb-3"></div>
                                        <div class="form-group">
                                            <label for=""><small>Tampilan Kiri</small></label>
                                            <div class="form-group">
                                                <img src="{{asset('storage'.$getJualanku->gmbr_kiri)}}"
                                                    id="preview_img1" class="img-thumbnail mb-1" style="width: 100%;">
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="profile_image1" class="custom-file-input"
                                                    id="profile_image1" onchange="loadPreview1(this);" accept="image/*">
                                                <label class="custom-file-label" for="customFile">Pilih</label>
                                            </div>
                                            @error('profile_image1')
                                            <small>
                                                <p class="text-danger pt-1">* {{ $message }}</p>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 pt-2">
                                        <div id="thumb-output" class="mb-3"></div>
                                        <div class="form-group">
                                            <label for=""><small>Tampilan Kanan</small></label>
                                            <div class="form-group">
                                                <img src="{{asset('storage'.$getJualanku->gmbr_kanan)}}"
                                                    id="preview_img2" class="img-thumbnail mb-1" style="width: 310px;">
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="profile_image2" class="custom-file-input"
                                                    id="profile_image2" onchange="loadPreview2(this);" accept="image/*">
                                                <label class="custom-file-label" for="customFile">Pilih</label>
                                            </div>
                                            @error('profile_image2')
                                            <small>
                                                <p class="text-danger pt-1">* {{ $message }}</p>
                                            </small>
                                            @enderror
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
                                            <div class="custom-file">
                                                <input type="file" name="profile_image3" class="custom-file-input"
                                                    id="profile_image3" onchange="loadPreview3(this);" accept="image/*">
                                                <label class="custom-file-label" for="customFile">Pilih</label>
                                            </div>
                                            @error('profile_image3')
                                            <small>
                                                <p class="text-danger pt-1">* {{ $message }}</p>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <label for="">Nama Barang</label>
                                        <input name="nama_barang" id="getNamaBarang" type="text" class="form-control"
                                            value="{{$getJualanku->nama_barang}}">
                                        @error('nama_barang')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label for="">Pilih Kategori</label>
                                        <select name="id_kategori" id="getKategori" class="form-control">
                                            <option value="{{$selectKategori->id}}">Terpilih -
                                                {{$selectKategori->kategori}}</option>
                                            @foreach($getKategori as $item)
                                            <option value="{{$item->id}}">
                                                {{$item->kategori}}
                                                @endforeach
                                            </option>
                                        </select>
                                        @error('id_kategori')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label for="">Harga</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control" name="harga" id="harga"
                                                value="{{$getJualanku->harga}}">
                                        </div>
                                        <small class="pt-2">* penginputan hanya menggunakan nominal harga barang</small>
                                        @error('harga')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 pt-4">
                                        <label for="">Jumlah</label>
                                        <input type="number" name="jumlah" class="form-control"
                                            value="{{$getJualanku->jumlah}}">
                                        @error('jumlah')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 pt-4">
                                        <label for="">Kondisi</label>
                                        <select name="kondisi" id="" class="form-control">
                                            <option value="{{$getJualanku->kondisi}}">
                                                <?php
                                                    if($getJualanku->kondisi == 1){
                                                        echo "Terpilih : Baru";
                                                    }else{
                                                        echo "Terpilih : Bekas";
                                                    }
                                                ?>
                                            </option>
                                            <option value="1">Baru</option>
                                            <option value="2">Bekas</option>
                                        </select>
                                        @error('kondisi')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 pt-4">
                                        <div class="row">
                                            <div class="col">
                                                <label for="">Berat (Kg)</label>
                                                <div class="input-group">
                                                    <input type="text" name="berat" class="form-control"
                                                        id="inlineFormInputGroupUsername"
                                                        value="{{$getJualanku->berat}}">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Kg</div>
                                                    </div>
                                                </div>
                                                @error('berat')
                                                <small>
                                                    <p class="text-danger pt-1">* {{ $message }}</p>
                                                </small>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label for="">Merek</label>
                                                <input type="text" name="merek" class="form-control"
                                                    value="{{$getJualanku->merek}}">
                                                @error('merek')
                                                <small>
                                                    <p class="text-danger pt-1">* {{ $message }}</p>
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pt-4">
                                        <label for="">Deskripsi</label>
                                        <textarea name="deskripsi" id="" cols="30" rows="10"
                                            class="form-control">{{$getJualanku->deskripsi}}</textarea>
                                        @error('deskripsi')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 pt-5 mb-5 d-flex justify-content-end">
                                        <button type="button" class="btn btn-inverse-primary btn-fw mr-2"
                                            onclick="window.location='{{url('/halaman_jualanku/daftar_barang')}}'">Batal
                                        </button>
                                        <button type="button" class="btn btn-inverse-primary btn-fw" data-toggle="modal"
                                            data-target="#simpanModal">Simpan</button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="simpanModal" tabindex="-1" role="dialog"
                                        aria-labelledby="simpanModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Konfirmasi Perubahaan Data Barang
                                                    <b>{{$getJualanku->nama_barang}}</b> Oleh {{Auth::User()->name}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <div class="col-md-1">
                            <!-- kosong -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<!-- Format Uang -->
<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
<script>
    // Harga format 
    $(document).ready(function () {
        var autoNumericInstance = new AutoNumeric('#harga', AutoNumeric.getPredefinedOptions().numericPos
            .dotDecimalCharCommaSeparator);
    });

    // Preview image
    function loadPreview(input, id) {
        id = id || '#preview_img';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(100 + '%')
                    .height(290);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function loadPreview1(input, id) {
        id = id || '#preview_img1';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(100 + '%')
                    .height(290);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function loadPreview2(input, id) {
        id = id || '#preview_img2';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(100 + '%')
                    .height(290);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function loadPreview3(input, id) {
        id = id || '#preview_img3';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(100 + '%')
                    .height(290);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection
