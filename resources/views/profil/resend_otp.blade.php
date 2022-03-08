@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">OTP Verifikasi Ulang</li>
                </ol>
            </nav>
        </div>

        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{url('halaman_profil/verifikasi_otp_ulang')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center mb-3 mt-2">
                                <img src="{{asset('/img/all/2.svg')}}" alt="" srcset="" style="width:60%;">
                            </div>
                            <div class="col-md-6">
                                <blockquote class="blockquote">
                                    <p class="mb-0">Pastikan nomor telepon dibawah apakah benar nomor yang {{Auth::User()->name}} gunakan sekarang : 
                                    </p>
                                </blockquote>
                                <div class="row">
                                    <div class="col-md-4 d-flex justify-content-center mt-4">
                                        <h1 class="display-3">No Telepon</h1>
                                    </div>
                                    <div class="col-md-8">
                                        <input name="phone" type="text" class="form-control mt-4" style="border-width: 0px 0px 2px" value="{{$getTelepon}}">
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <small>Kode OTP tidak masuk silahkan <b><a href="">hubungi kami</a></b></small>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary btn-icon-text">
                                        Kirim OTP
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
