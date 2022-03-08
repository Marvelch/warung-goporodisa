<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ENV('APP_NAME')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/all.css')}}">
</head>

<body>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 mt-5">
                    <div class="card shadow">
                        <!-- <div class="card-header">{{ __('Register') }}</div> -->

                        <div class="card-body m-5 ml-5">
                            <div class="form-group">
                                <img src="{{asset('images/logo.png')}}" alt="" srcset="" style="width: 90%;">
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-form-label">Nama Lengkap</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-form-label">Kata Sandi</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-form-label">Konfirmasi Kata Sandi</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                        <label class="form-check-label" for="exampleCheck1"><small>Setuju dengan <a
                                                    data-toggle="modal" data-target="#exampleModalCenter">Baca
                                                    syarat
                                                    & ketentuan</a></small></label>
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mt-4">
                                    <button type="submit" class="btn btn-secondary font-weight-bold">
                                        <span class="ml-3 mr-3">{{ __('Register') }}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-start">
                            <div class="form-group mt-3">
                                <a href="{{URL('/')}}"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <div class="form-group mt-3">
                                <a href="{{URL('/login')}}">Login <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body small">
                        <p class="font-weight-bold">Syarat & Ketentuan</p>
                        <br>
                        <div class="form-group">
                            <p class="font-weight-bold">Keamanan, Akun, Saldo Penghasilan, Password dan
                                Saldo Refund</p>
                        </div>
                        <li>Pengguna dengan ini menyatakan bahwa pengguna adalah orang yang cakap dan mampu
                            untuk mengikatkan dirinya dalam sebuah perjanjian yang sah menurut hukum.</li>
                        <li>Goporodisa tidak memungut biaya pendaftaran kepada Pengguna.</li>
                        <li>Pengguna memahami bahwa 1 (satu) nomor telepon hanya dapat digunakan untuk
                            mendaftar 1 (satu) akun Pengguna Goporodisa, kecuali bagi Pengguna yang telah
                            memiliki beberapa akun dengan 1 (satu) nomor telepon sebelumnya.</li>
                        <br>
                        <p class="font-weight-bold"><a href="www.goporodisa.com/ka_halaman/syarat_dan_ketentuan">Baca
                                Selengkapnya</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
