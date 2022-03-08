@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Jualanku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <!-- kosong -->
                        </div>
                        <div class="col-md-10">
                            <!-- Pengecekan status pada table toko dan table seller -->
                            @if($getToko == null || $getPhone == null)
                            <div class="row">
                                <div class="col-md-4 pt-5">
                                    <img src="{{asset('img/all/error.png')}}" alt="" srcset="" style="width: 100%;">
                                </div>
                                <div class="col-md-8 pt-5">
                                    <form>
                                        <div class="row">
                                            <div class="col">
                                                <div class="card shadow" style="width: 18rem;">
                                                    <img class="card-img-top" src="{{asset('img/all/idea.png')}}" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Toko</h5>
                                                        <p class="card-text">Buat toko kamu lebih ramai dengan bergabung di Goporodisa
                                                        </p>
                                                        <a href="{{url('/page_toko/toko')}}" class="btn btn-primary mt-2 col-md-12">Buat Toko</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card shadow" style="width: 18rem;">
                                                    <img class="card-img-top" src="{{asset('img/all/maps.png')}}" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Nomor Telpon</h5>
                                                        <p class="card-text">Goporodisa lebih mudah untuk menghubungi nomor telpon
                                                        </p>
                                                        <a href="{{url('/halaman_profil/profil')}}" class="btn btn-primary mt-2 col-md-12">Tambah No Telpon</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- <ul>
                                        <li>Kamu belum memiliki toko - <a href="{{url('/page_toko/toko')}}"> Buat Toko
                                                Sekarang</a></li>
                                        <li>Verifikasi no telepon - <a
                                                href="{{url('/halaman_profil/profil')}}">Verifikasi No Telepon</a></li>
                                    </ul> -->
                                </div>
                            </div>
                            @else
                            <form action="{{url('halaman_jualanku/jualanku')}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 pt-5">
                                        <label for="">Nama Barang</label>
                                        <input name="nama_barang" id="getNamaBarang" type="text" class="form-control">
                                        @error('nama_barang')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 pt-2">
                                        <div id="thumb-output" class="mb-3"></div>
                                        <div class="form-group">
                                            <label for=""><small>Tampilan Utama</small></label>
                                            <div class="form-group">
                                                <img src="{{asset('img/all/docs.png')}}" id="preview_img"
                                                    class="img-thumbnail mb-1 shadow" style="width: 100%;">
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
                                                <img src="{{asset('img/all/docs.png')}}" id="preview_img1"
                                                    class="img-thumbnail mb-1 shadow" style="width: 100%;">
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
                                                <img src="{{asset('img/all/docs.png')}}" id="preview_img2"
                                                    class="img-thumbnail mb-1 shadow" style="width: 310px;">
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
                                                <img src="{{asset('img/all/docs.png')}}" id="preview_img3"
                                                    class="img-thumbnail mb-1 shadow" style="width: 310px;">
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
                                    <div class="col-md-12">
                                        <label for="">Pilih Kategori</label>
                                        <select name="id_kategori" id="getKategori" class="form-control">
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
                                            <input type="text" class="form-control" name="harga" id="harga">
                                        </div>
                                        <small class="pt-2">* penginputan hanya menggunakan nominal harga barang</small>
                                        @error('harga')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 pt-4">
                                        <label for="">Stok</label>
                                        <input type="number" name="jumlah" class="form-control">
                                        @error('jumlah')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 pt-4">
                                        <label for="">Kondisi</label>
                                        <select name="kondisi" id="" class="form-control">
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
                                                        id="inlineFormInputGroupUsername">
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
                                                <input type="text" name="merek" class="form-control">
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
                                        <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
                                        @error('deskripsi')
                                        <small>
                                            <p class="text-danger pt-1">* {{ $message }}</p>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 pt-5 mb-5 d-flex justify-content-end">
                                        <button class="btn btn-inverse-primary btn-fw mr-2">Simpan</button>
                                    </div>
                            </form>
                            @endif
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
