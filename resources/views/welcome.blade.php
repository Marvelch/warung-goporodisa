<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WARUNG GOPORODISA</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Font Style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            padding-top: 120px;
            padding-bottom: 220px;
        }

        .card {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.2s ease-in-out;
        }

        .featured {
            /* height: 90vh; */
            background-image: url(https://snap-photos.s3.amazonaws.com/img-thumbs/960w/J98HWXTPPV.jpg);
            background-size: cover;
            background-position: 50%;
            min-height: 414px;
            opacity: 0.8;
        }

        .sub-featured {
            height: 49vh;
            margin-bottom: 5vh;
            min-height: 226px;
            max-height: 326px;
        }

        .sub-featured h2 {
            font-size: 1.2em;
        }

        .non-featured {
            height: 36vh;
            min-height: 167px;
        }

        .card {
            background-color: #efefef;
            padding: 10px 15px;
            position: relative;
        }

        .non-featured h2 {
            font-size: 1.1em;
            position: absolute;
            bottom: 5px;
        }

        .accent {
            background-color: #33a2ae;
            background-image: url(https://snap-photos.s3.amazonaws.com/img-thumbs/960w/0UR6B61LVN.jpg);
            background-position: 50%;
            opacity: 0.9;
        }

        @media screen and (max-width: 992px) {
            .col-md-6 {
                margin-bottom: 5vh;
            }

            .sub-featured {
                margin-bottom: 0vh;
            }
        }

    </style>
    <!-- <link rel="stylesheet" href="{{asset('css/vertical-layout-light/style.css')}}"> -->
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-6 featured-container">
                <div class="card featured">
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card sub-featured">
                    <h2>Hey Gopopers</h2>
                    <p>Goporodisa telah menyediakan layanan <b>warung goporodisa</b>. Layanan warung goporodisa dibuat dengan tujuan pengelolaan produk - produk dari penjual di goporodisa.com</p>
                    <br>
                    <p>Temukan peluang usaha terbaik dengan bergabung bersama goporodisa. Temukan pasar penjualan yang lebih besar dan peluang usaha baru. <a href="{{URL('/register')}}">Gabung Besarama Goporodisa</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="row">
                <div class="col-md">
                    <h1>SeGoporodisa</h1>
                </div>
            </div>
            <div>
                <img src="{{asset('images/logo.png')}}" alt="" srcset="" class="hello">
            </div>
            <div class="links">
                SeGoporodisa adalah layanan pengelolaan penjualan bagi seller goporodisa
            </div>
        </div>
    </div> -->
</body>

</html>
