@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi Bermasalah</li>
                </ol>
            </nav>

            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-border">
                                <thead>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Konfirmasi Hingga</th>
                                        <th>Total Bayar</th>
                                        <th>Keterangan</th>
                                        <th>Kontak CS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getTransaksi as $key => $item)
                                    <tr>
                                        <td>{{$item[0]->kode_transaksi}}</td>
                                        <td><?php echo date('d-m-Y',strtotime($item[0]->batas_konfirmasi_pesanan)); ?></td>
                                        <td><?php echo "Rp " . number_format($item[0]->total_bayar,0,',','.');?></td>
                                        <td><small>kode transaksi terdapat beberapa transaksi pada toko yang berbeda. Hubungi CS untuk mengetahui informasi transaksi.</small></td>
                                        <td><a class="btn btn-primary" target="_blank" href="{{URL('https://api.whatsapp.com/send?phone=081398739434&text='.Auth::User()->email.' Kode Transaksi : '.$item[0]->kode_transaksi.'%20Tolong Detail Masalah')}}"><i class="fas fa-phone-square-alt fa-2x"></i></a></td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
