<?php

namespace App\Http\Controllers;

use App\Models\Layanan;

class HomeController extends Controller
{
    public function index()
    {
        $layanan = Layanan::where('aktif', true)->take(6)->get();
        return view('welcome', compact('layanan'));
    }
}