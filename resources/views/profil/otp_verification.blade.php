@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">OTP</li>
                </ol>
            </nav>
        </div>

        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    @if($getSellers[0]->block_otp_time == null)
                    <form action="{{url('halaman_profil/proses_verifikasi_otp')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center mt-4">
                                <img src="{{asset('/img/all/otp.svg')}}" alt="" srcset="" style="width:60%;">
                            </div>
                            <div class="col-md-6">
                                <blockquote class="blockquote">
                                    <p class="mb-0">Periksa kontak SMS dan Whatsapp yang berisi kode OTP dari Goporodisa :
                                    </p>
                                </blockquote>
                                <div class="row">
                                    <div class="col-md-4 d-flex justify-content-center mt-4">
                                        <h1 class="display-3">Kode OTP</h1>
                                    </div>
                                    <div class="col-md-8">
                                        <input name="otp_code" type="text" class="col-md-10 form-control mt-4"
                                            style="border-width: 0px 0px 2px" placeholder="454xx" pattern="[0-9]*">
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <small>Bermasalah dengan no telepon ? <a
                                            href="{{url('halaman_profil/verifikasi_otp_ulang_tampilan')}}">Ganti no
                                            telpon baru</a> atau <a
                                            href="{{url('halaman_profil/verifikasi_otp_ulang_tampilan')}}">kirim OTP
                                            ulang</a></small>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary btn-icon-text">
                                        Verifikasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @elseif (date('Y-m-d') >= $getSellers[0]->block_otp_time)
                    <form action="{{url('halaman_profil/verifikasi_otp_ulang')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center  mb-3">
                                <img src="{{asset('/img/all/2.svg')}}" alt="" srcset="" style="width:80%;">
                            </div>
                            <div class="col-md-6">
                                <blockquote class="blockquote">
                                    <p class="mb-0">{{Auth::User()->name}} nomor telepon anda sebelumnya telah <b class="text-danger">terblokir oleh sistem</b>. Pastikan nomor telepon pada kolom dibawah telah sesuai dengan nomor yang anda gunakan sekarang :
                                    </p>
                                </blockquote>
                                <div class="row">
                                    <div class="col-md-4 d-flex justify-content-center mt-4">
                                        <h1 class="display-3">No Telepon</h1>
                                    </div>
                                    <div class="col-md-8">
                                        <input name="phone" type="text" class="form-control mt-4"
                                            style="border-width: 0px 0px 2px" value="{{$getSellers[0]->phone}}">
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
                    @else
                    <h2>Sorry...</h2>
                    <p class="mt-3">Kamu sudah melakukan verifikasi OTP terlalu sering. Silahkan coba lagi besok hari !
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
