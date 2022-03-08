@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Saldo</li>
                </ol>
            </nav>
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{URL('page_penarikan_dana/penarikan_dana')}}" method="post" autocomplate="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="alert alert-primary shadow" role="alert">
                                    <h4 class="alert-heading">PEMBERITAHUAN</h4>
                                    <p>Proses penarikan dana memerlukan waktu 1 x 24 jam untuk memverifikasi data
                                        penjualan dari toko untuk memastikan ketepatan data transaksi pada setiap toko.
                                    </p>
                                    <hr>
                                    <p class="mb-0">Catatan : Untuk menghindari kesalahan silahkan cocokkan dengan
                                        faktur
                                        dari <b>Goporodisa.com</b></p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mt-2">
                                    <h3 id="saldo_sekarang"><?php echo "Rp " . number_format($fix_saldo,0,',','.'); ?>
                                    </h3>
                                    <input type="hidden" name="saldo" value="{{$fix_saldo}}" id="saldo">
                                </div>
                                <div class="form-group">
                                    <label for="">Pilih Rekening</label>
                                    <select name="id_rekening" id="penarikan_dana" class="form-control">
                                        @foreach($getBank as $item)
                                        <option value="{{$item->id}}">{{$item->Banks->nama_bank}} -
                                            {{$item->nomor_rekening}} -
                                            {{$item->nama_pemilik_rekening}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_rekening')
                                    <small>
                                        <p class="text-danger pt-1">* {{ $message }}</p>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Dana</label>
                                    <input name="jumlah" type="text" class="form-control" id="jumlah">
                                    @error('jumlah')
                                    <small>
                                        <p class="text-danger pt-1">* {{ $message }}</p>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kata Sandi</label>
                                    <div class="input-group mb-2">
                                        <input type="password" name="password" class="form-control" id="password">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-eye" id="icon_eye"
                                                    onclick="Shfunction()"></i></div>
                                        </div>
                                    </div>
                                    @error('keterangan')
                                    <small>
                                        <p class="text-danger pt-1">* {{ $message }}</p>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="tarik_dana" disabled>Tarik Dana</button>
                                </div>
                                <p class="text-danger">
                                    <small><span id="error"></span></small>
                                </p>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {
        $('input').attr('autocomplete', 'off');
    });

    function Shfunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }

        $('#icon_eye').toggleClass('fas fa-eye').toggleClass('fas fa-eye-slash');
    }

    $('#jumlah').on('change', function () {
        var saldo = $('#saldo').val();
        var saldo_sekarang = $('#saldo_sekarang').text();
        var penarikan = $('#jumlah').val().replace(/[.\{\}\[\]\\\/]/gi, '');

        if (parseInt(penarikan) > parseInt(saldo)) {
            $('#error').text('Saldo Tidak Cukup. Tidak Boleh Lebih Dari ' + saldo_sekarang);
        } else if (parseInt(penarikan) < 10000) {
            $('#error').text('Tidak Boleh Kurang Dari Rp 10.000');
        } else if (penarikan == '') {
            $('#error').show('Jumlah Penarikan Tidak Boleh Kosong');
        } else {
            $('#tarik_dana').prop('disabled', false);
        }
    });

    // Format Rupiah 
    var rupiah = document.getElementById('jumlah');
    rupiah.addEventListener('keyup', function (e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

</script>
@endsection
