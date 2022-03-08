@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cek Pesanan</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{URL('page_pesanan/terima_pesanan/'.$getTransaksi[0]->kode_transaksi)}}"
                            method="post">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Status Pesanan</th>
                                            <th>Total Bayar</th>
                                            <th>Pengambilan Paket</th>
                                            <th>Batas Waktu Konfirmasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getTransaksi as $item)
                                        <tr>
                                            <td>
                                                @if($item->ket_stok)

                                                @else
                                                <select name="ket_stok[]" id="" class="form-control">
                                                    <option value="1">Tersedia</option>
                                                    <option value="2">Kosong</option>
                                                </select>
                                                @endif
                                            </td>
                                            <td>{{$item->nama_barang}}
                                                <?php 
                                                $kode_transaksi = Crypt::encryptString($item->kode_transaksi);
                                                $id_transaksi   = Crypt::encryptString($item->id);
                                            ?>
                                                <input type="hidden" name="kode_transaksi" value="{{$kode_transaksi}}">
                                                <input type="hidden" name="id_transaksi[]" value="{{$id_transaksi}}">
                                            </td>
                                            <td>{{$item->jumlah_pesanan}}</td>
                                            <td><?php 
                                                if($item->ket_stok == 1)
                                                {
                                                    echo "<span class='badge badge-primary'>PROSES SEKARANG</span>";
                                                }elseif($item->ket_stok == NULL){
                                                    
                                                }else{
                                                    echo "<span class='badge badge-danger'>STOK KOSONG</span>";
                                                }
                                            ?></td>
                                            <td><?php echo "Rp " . number_format($item->harga_barang * $item->jumlah_pesanan,0,',','.'); ?>
                                            </td>
                                            <td><?php echo date("d-m-Y", strtotime($item->batas_waktu_pengiriman))." 10:00:00"; ?>
                                            </td>
                                            <td><?php echo date("d-m-Y", strtotime($item->batas_waktu_pengiriman))." 08:00:00"; ?>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Modal -->
                                <div class="modal fade" id="terimaModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    KONFIRMASI</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <small>
                                                    Cek stok barang sebelum mengkonfirmasi pesanan,
                                                    <a href="{{url('/halaman_jualanku/daftar_barang')}}">
                                                        cek stok barang</a> untuk menghindari
                                                    pembatalan otomatis oleh sistem.
                                                </small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Iya. Terima</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><small><b>Pesan Dari Pelanggan :</b></small></label>
                                <!-- <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea> -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mengecek apabila transaksi dibatalkan oleh pembeli -->
                    @if($getTransaksi[0]->status_pesanan == 1)                        
                        <div class="col-md-12  d-flex justify-content-end">
                            <div class="form-group m-3">
                                <a class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalLong"><i
                                        class="fas fa-print mr-2"></i> Cetak
                                </a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <small>
                                                <p>Perhatikan sebelum mencetak <i>(print)</i> invoice
                                                    <i>{{$getTransaksi[0]->kode_transaksi}}</i></p>
                                                <ul>
                                                    <li>
                                                        Tempelkan kertas invoice pada paket yang akan dikirim.
                                                    </li>
                                                    <li>
                                                        Invoice digunakan untuk bukti pada saat pencairan dana Gpayment.
                                                    </li>
                                                </ul>
                                            </small>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <a href="{{URL('page_pesanan/pdf/'.$item->kode_transaksi)}}"
                                                class="btn btn-primary">Print</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($getTransaksi[0]->status_pesanan == 2)
                    <i>
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">
                                PAKET DITERIMA OLEH KURIR
                            </div>
                        </div>
                    </i>
                    @elseif($getTransaksi[0]->status_pesanan == 3 AND $getTransaksi[0]->konfirmasi_pelanggan != NULL)
                    <i>
                        <div class="form-group">
                            <div class="alert alert-primary" role="alert">
                                TERIMA KASIH. PAKET TELAH DITERIMA PELANGGAN.
                            </div>
                        </div>
                    </i>
                    @elseif($getTransaksi[0]->status_pesanan == 3)
                    <i>
                        <div class="form-group">
                            <div class="alert alert-primary" role="alert">
                                PAKET TELAH DIKIRIM OLEH KURIR
                            </div>
                        </div>
                    </i>
                    @elseif($getTransaksi[0]->status_pesanan == 4)
                    <i>
                        <div class="form-group">
                            <div class="alert alert-primary" role="alert">
                                TRANSAKSI BATAL. <a href="">Baca syarat & ketentuan</a>
                            </div>
                        </div>
                    </i>
                    @elseif($getTransaksi[0]->status_pesanan == 5)
                    <i>
                        <div class="form-group">
                            <div class="alert alert-primary" role="alert">
                                TRANSAKSI BERMASALAH
                            </div>
                        </div>
                    </i>
                    @else
                    <div class="col-md-12  d-flex justify-content-start mr-5">
                        <div class="form-group">
                            <button type="button" class="btn btn-outline-primary shadow" data-toggle="modal"
                                data-target="#terimaModal">Konfirmasi Pesanan</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
        $('#btn_terima').on('click', function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var kode_transaksi = $("input[name=kode_transaksi]").val();

            $.ajax({
                url: "{{URL('page_pesanan/terima_pesanan')}}",
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",

                    'kode_transaksi': kode_transaksi,
                },
                success: function (e) {
                    // window.location = e;
                    console.log(e)
                },
                error: function (e) {
                    alert('Kesalahan teknik pada sistem. Tolong hubungi kami.');
                }
            });
        });

        $('#btn_tolak').on('click', function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var kode_transaksi = $("input[name=kode_transaksi]").val();

            var id_transaksi = $('input[name^=id_transaksi]').map(function (idx, log) {
                return $(log).val();
            }).get();

            $.ajax({
                url: "{{URL('page_pesanan/tolak_pesanan')}}",
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",

                    'kode_transaksi': kode_transaksi,
                    'id_transaksi': id_transaksi,
                },
                success: function (e) {
                    window.location = e;
                    // console.log(e);
                },
                error: function (e) {
                    alert('Transaksi mengalami kesalahan hubungi CS Goporodisa');
                    // console.log(e)
                }
            });
        });

    </script> -->
@endsection
