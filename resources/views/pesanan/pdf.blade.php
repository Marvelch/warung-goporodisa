<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>{{$getTransaksi->kode_transaksi}} - {{ENV('APP_NAME')}}</title>
    <style>
        .title {
            text-align: center;
        }

        .extra-small {
            font-size: 10px;
        }

        table,
        td {
            border: 0.5px solid black;
            border-collapse: collapse;
            padding: 5px;
            font-size: 10px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4 text-center">
                <div class="form-group title">
                    <h3>{{ENV('APP_NAME')}} Invoice</h3>
                    <p class="extra-small" style="margin-top: -12px;"><i>Goporodisa - Go Digital Tanah Porodisa</i></p>
                </div>
                <p style="font-size: 10px;">
                    <i>Kode Transaksi : {{$getTransaksi->kode_transaksi}} |
                        <?php echo date("d-m-Y"); ?></i>
                </p>
            </div>
            <table>
                <tr>
                    <td>Nama Barang</td>
                    <td>Qty</td>
                    <td>Berat (Kg)</td>
                    <td>Harga Barang</td>
                    <td>Metode Pembayaran</td>
                    <td>Tanggal Pemesanan</td>
                    <td>Tanggal Pengiriman</td>
                </tr>
                <tr>
                    <td>{{$getTransaksi->nama_barang}}</td>
                    <td>{{$getTransaksi->jumlah_pesanan}}</td>
                    <td>{{$getTransaksi->berat}}</td>
                    <!-- <td><?php echo "Rp " . number_format($getTransaksi->biaya_layanan,0,',','.'); ?></td> -->
                    <td><?php echo "Rp " . number_format($getTransaksi->total_harga_barang,0,',','.'); ?></td>
                    <td><?php if($getTransaksi->metode_pembayaran == 0){
                            echo "Transfer Bank";
                        }else{
                            echo "COD (Cash On Delivery)";
                        }
                        ?></td>
                        <td><?php echo date("d-m-Y", strtotime($getTransaksi->tanggal_transaksi)); ?></td>
                    <td><?php echo date("d-m-Y", strtotime($getTransaksi->batas_waktu_pengiriman))." 10:00:00" ?></td>
                </tr>
            </table>
            <div class="form-group" style="font-size : 10px;">
                <p>Pesan Pelanggan :</p>
            </div>
        </div>
    </div>
    <div class="form-group title extra-small">
        <p>
            <i>Syarat dan ketentuan Goporodisa berlaku bagi semua transaksi</i>
        </p>
    </div>
    <hr>
</body>

</html>
