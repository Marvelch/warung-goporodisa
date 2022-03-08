@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
                </ol>
            </nav>
            
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-border">
                                <thead>
                                    <tr>
                                        <th>
                                            Kode Transaksi
                                        </th>
                                        <th>
                                            Pembayaran
                                        </th>
                                        <th>
                                            Total Bayar
                                        </th>
                                        <th>
                                            Tanggal Transaksi
                                        </th>
                                        <th>
                                            Tanggal Pengambilan
                                        </th>
                                        <th>Status Paket</th>
                                        <th>Lainnya</th>
                                    </tr>
                                </thead>
                                <!-- Gunakan @ untuk pengkodean php foreach($getTransaksi->groupBy('kode_transaksi') as $item) -->
                                @foreach($getTransaksi as $key => $item) 
                                <tbody>
                                    <tr>
                                        <td>{{$item[0]->kode_transaksi}}</td>
                                        <td><?php 
                                            if($item[0]->status_pembayaran == 1)
                                            {
                                                echo "<span class='badge badge-primary'>Pembayaran Diterima</span>";
                                            }else if($item[0]->status_pesanan == 2){
                                                echo "Pembayaran Diterima";
                                            }
                                        ?></td>
                                        <td><?php echo "Rp " . number_format($item[0]->total_harga_barang,0,',','.');?>
                                        </td>
                                        <td><?php echo date('d-m-Y',strtotime($item[0]->tanggal_transaksi)); ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($item[0]->batas_waktu_pengiriman)). " 08:00:00" ?>
                                        </td>
                                        <td><?php 
                                            if($item[0]->status_pesanan == NULL)
                                            {
                                                echo "<span class='badge badge-primary'>Belum Diproses</span>";
                                            }elseif($item[0]->status_pesanan == 1) {
                                                echo "<span class='badge badge-primary'>Diproses Oleh Toko</span>";
                                            }elseif($item[0]->status_pesanan == 2) {
                                                echo "<span class='badge badge-primary'>Diterima Oleh Kurir</span>";
                                            }elseif($item[0]->status_pesanan == 3) {
                                                echo "<span class='badge badge-primary'>Selesai</span>";
                                            }elseif($item[0]->status_pesanan == 5) {
                                                echo "<span class='badge badge-primary'>Transaksi Bermasalah</span>";
                                            }else{
                                                echo "<span class='badge badge-danger'>Transaksi Batal</span>";
                                            }

                                        ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="{{URL('page_pesanan/pesanan/'.$item[0]->kode_transaksi)}}"><i class="fas fa-search"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$getRincianTransaksi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
