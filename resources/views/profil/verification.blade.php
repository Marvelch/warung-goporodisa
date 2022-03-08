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
                    <form action="{{url('halaman_profil/otp')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <img src="{{asset('/img/all/otp.svg')}}" alt="" srcset="" style="width:60%; margin-top: 10%;">
                            </div>
                            <div class="col-md-6 ">
                                <blockquote class="blockquote">
                                    <p class="mb-0">Verifikasi nomor telepon dengan permintaan kode OTP ke kontak SMS atau Whatsapp :
                                    </p>
                                </blockquote>
                                <div class="row">
                                    <div class="col-md-4 d-flex justify-content-center mt-4">
                                        <h1 class="display-3">No Telepon</h1>
                                    </div>
                                    <div class="col-md-8">
                                        <input name="phone" type="text" class="form-control mt-4" style="border-width: 0px 0px 2px"
                                            placeholder="082217xxxx" pattern="[0-9]*">
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-primary btn-icon-text">
                                        Verifikasi
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
