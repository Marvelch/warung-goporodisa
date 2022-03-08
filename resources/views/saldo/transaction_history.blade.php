@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Transaksi</li>
                </ol>
            </nav>
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Kode Transaksi</th>
                                                <th>Total</th>
                                                <th>Status Transaksi</th>
                                                <th>Status Penarikan</th>
                                                <th>Tanggal Transaksi</th>
                                            </tr>
                                        </thead>
                                        @foreach($getRiwayatTransaksi as $key => $item)
                                        <tbody>
                                            <tr>
                                                <td>{{$item->kode_transaksi}}</td>
                                                <td><?php  

                                                    if($item->status_transaksi == 1)
                                                    {
                                                        echo " + ";
                                                    }else{
                                                        echo " - ";
                                                    }
                                                    echo "Rp " . number_format($item->total,0,',','.'); ?></td>
                                                <td class="text-center">
                                                    <?php 
                                                        if($item->status_transaksi == 1)
                                                        {
                                                            echo "<i class='far fa-arrow-alt-circle-up fa-lg text-primary' title='Penerimaan'></i>";
                                                        }else{
                                                            echo "<i class='far fa-arrow-alt-circle-down fa-lg text-danger' title='Penarikan'></i>";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($item->status_penarikan == null)
                                                        {
                                                            
                                                        }else{
                                                            echo "Transaksi Berhasil";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date("d-m-Y", strtotime($item->tanggal)) ?></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4 text-center" style="margin-top: 3%;">
                                <img src="{{URL('img/all/idea.png')}}" alt="" srcset="" style="width: 60%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4">
                    {{$getRiwayatTransaksi->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
