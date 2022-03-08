@extends('layouts.app_primary')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>
        </div>

        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <h5 class="card-title text-uppercase"><i class="fas fa-id-badge mr-2"></i>
                                            BIODATA {{Auth::User()->name}}</h5>
                                        <hr>
                                    </div>
                                    <p class="card-description">
                                        Informasi yang terlampir adalah data sesuai pendaftaran awal pengguna.
                                    </p>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <address class="text-primary">
                                                <p class="font-weight-bold">
                                                    E-mail
                                                </p>
                                                <p class="mb-2">
                                                    {{Auth::User()->email}}
                                                </p>
                                                <p class="font-weight-bold mt-4">
                                                    No Telepon
                                                </p>
                                                <p class="mt-1">
                                                    <?php

                                                    if(Auth::User()->phone == null)
                                                    {
                                                        echo "<a href='/halaman_profil/verification'>Verifikasi No Telepon</a>";
                                                    }else if(Auth::User()->phone_verified == 1){
                                                        echo Auth::User()->phone." - Terverifikasi <i class='fas fa-check-circle' title='Terverifikasi Icon'></i>";
                                                    }else{
                                                        echo "<a href='/halaman_profil/tampilan_verifikasi_otp'>Verifikasi OTP (One Time Password)</a>";
                                                    }
                                                    ?>
                                                </p>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <!-- <button type="button" class="btn btn-inverse-primary btn-fw">Ubah Profil</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 grid-margin">
                            <div class="card-body">
                                <div class="form-group">
                                    <h4 class="card-title text-uppercase"><i class="fas fa-university mr-2"></i>
                                        Rekening Bank</h4>
                                    <hr>
                                </div>

                                @if(!empty($getBank))
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="text-primary font-weight-bold">Nama
                                                </td>
                                                <td> : {{$getBank->nama_pemilik_rekening}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary font-weight-bold">No Rekening</td>
                                                <td> : {{$getBank->nomor_rekening}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary font-weight-bold">Bank</td>
                                                <td> : {{$getBank->Banks->nama_bank}}</td>
                                            </tr>
                                            <tr>
                                                <?php
                                                            $id = Crypt::encrypt($getBank->id);
                                                        ?>
                                                <td><b><a href="{{URL('page_bank/bank/'.$id)}}"
                                                            style="margin-left: 1px; color: #4b49ac;"><u>Ubah
                                                                Rekening</u></a></b></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <blockquote class="blockquote mb-0">
                                    <p>Pastikan menggunakan rekening bank pribadi sehingga proses verifikasi akan lebih mudah. Apabila terdapat perbedaan rekening bank dan biodata harap konfirmasi melalui whatsapp.</p>
                                    <footer class="blockquote-footer"><i><small>Baca Syarat & Ketentuan</small></i>
                                        <footer>
                                </blockquote>
                                <div class="form-group mt-3">
                                    <a href="{{URL('page_bank/bank')}}"><span
                                            class="badge badge-pill badge-primary">Tambah Rekening Bank</span></a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
