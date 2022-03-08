@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Barang Jualanku</li>
                </ol>
            </nav>
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Nama Barang
                                                        </th>
                                                        <th>
                                                            Status
                                                        </th>
                                                        <th>
                                                            Harga
                                                        </th>
                                                        <th>
                                                            Jumlah
                                                        </th>
                                                        <th>
                                                            Lainnya
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($getJualanku as $item)
                                                    <tr>
                                                        <td>
                                                            {{$item->nama_barang}}
                                                        </td>
                                                        <td class="py-1">
                                                            <?php
                                                                if($item->status == 1)
                                                                {
                                                                    echo "<button class='btn btn-outline-info btn-rounded btn-icon' title='Aktif'><i class='fas fa-check'></i></button>";
                                                                }else{
                                                                    echo "<button class='btn btn-outline-danger btn-rounded btn-icon' title='Tidak Aktif'><i class='fas fa-times'></i></button>";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo "Rp " . number_format($item->harga, 0, ",", "."); ?>
                                                        </td>
                                                        <td>
                                                            {{$item->jumlah}}
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $id = Crypt::encrypt($item->id);
                                                            ?>
                                                            <button type="button" class="btn btn-primary"
                                                                onclick="window.location='{{ URL ('halaman_jualanku/jualanku/'.$id)}}/'"><i class="fas fa-search"></i></button>
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group pl-3">
                                        {{$getJualanku->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
