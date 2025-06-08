<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer']);
    }

    public function dashboard()
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->with('layanan')
            ->latest()
            ->take(5)
            ->get();

        $totalPesanan = Pesanan::where('user_id', Auth::id())->count();
        $pesananMenunggu = Pesanan::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->count();

        return view('customer.dashboard', compact('pesanan', 'totalPesanan', 'pesananMenunggu'));
    }

    public function layanan()
        {
            $layanans = Layanan::all(); // pastikan model Layanan sudah dibuat dan terkoneksi
            return view('customer.layanan.index', compact('layanans'));
        }

}