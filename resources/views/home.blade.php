@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <!-- <h3 class="font-weight-bold">Hey {{Auth::User()->name}}</h3>
                    <p class="font-weight-normal pt-2">Tambahkan barang jualan kamu ke goporodisa, tapi yuk
                        {{Auth::User()->name}} lengkapi <a href="{{url('/page_toko/toko')}}"><b>toko</b></a> kamu.</p> -->
                </div>
                <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> <?php echo "Tanggal Sekarang : ".date('d-m-Y'); ?>
                            </button>
                            <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-people mt-auto">
                    <img src="{{asset('images/dashboard/Goporodisa.png')}}" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div>
                                <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                            </div>
                            <div class="ml-2">
                                <h4 class="location font-weight-normal">Indonesia</h4>
                                <h6 class="font-weight-normal">Manado</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale shadow">
                        <div class="card-body">
                            <h5 class="mb-4">Proses Transaksi</h5>
                            <p class="fs-30 mb-2"><?php echo count($getProses); ?></p>
                            <small><i>transaksi sedang diproses oleh penjual (seller)</i></small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue shadow">
                        <div class="card-body">
                            <h5 class="mb-4">Paket Terkirim</h5>
                            <p class="fs-30 mb-2"><?php echo count($getDiterima); ?></p>
                            <small><i>pengiriman paket telah diterima oleh pelanggan</i></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue shadow">
                        <div class="card-body">
                            <h5 class="mb-4">Menunggu Konfirmasi</h5>
                            <p class="fs-30 mb-2"><?php echo count($getMenunggu); ?></p>
                            <small><i>pembelian menunggu konfirmasi dari penjual</i></small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger shadow">
                        <div class="card-body">
                            <h5 class="mb-4">Transaksi Berhasil</h5>
                            <p class="fs-30 mb-2"><?php echo count($getSelesai); ?></p>
                            <small><i>paket telah diterima oleh pelanggan</i></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
