<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $getProses = Transaksi::where('status_pesanan',1)->get();

        $getDiterima = Transaksi::where('status_pesanan',2)->get();

        $getMenunggu = Transaksi::where('status_pesanan',0)->get();

        $getSelesai = Transaksi::where('status_pesanan',3)->get();

        return view('home',compact('getProses','getDiterima','getMenunggu','getSelesai'));
    }
}
