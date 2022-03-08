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
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-5 mt-1 mb-5">
                    <div class="card shadow">
                        <!-- <div class="card-header">{{ __('Login') }}</div> -->
                        <div class="card-body m-4">
                            <div class="form-group">
                                <img src="{{asset('images/logo.png')}}" alt="" srcset=""
                                    style="width: 90%; margin: 5px;">
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row mt-4">
                                    <label for="email" class="col-form-label">Email</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                        required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row mt-3">
                                    <small>
                                        Belum memiliki akun ? <a href="{{URL('register')}}">Daftar Sekarang</a> -
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            Lupa password
                                        </a>
                                        @endif
                                    </small>
                                </div>

                                <div class="form-group row">
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-secondary mt-3 font-weight-bold">
                                                <span class="ml-3 mr-3">{{ __('Login') }}</span>
                                            </button>
                                        </div>
                                        <div class="col text-center d-flex align-items-center mt-3">
                                        
                                        </div>
                                    </div>
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
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
</body>

</html>
