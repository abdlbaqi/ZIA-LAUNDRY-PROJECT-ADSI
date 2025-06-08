<?php

// app/Http/Controllers/Customer/PembayaranController.php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function create($pesanan_id)
    {
        $pesanan = Pesanan::with('user')->findOrFail($pesanan_id);
        return view('customer.pembayaran.create', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanan,id',
            'metode'     => 'required|string',
            'bukti'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pesanan = Pesanan::findOrFail($request->pesanan_id);

        // Ambil total dari pesanan
        $totalHarga = $pesanan->total_harga;

        // Simpan file bukti jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')
                               ->store('bukti-pembayaran', 'public');
        }

        Pembayaran::create([
            'user_id'     => Auth::id(),
            'pesanan_id'  => $pesanan->id,   // → simpan ID pesanan
            'total_harga' => $totalHarga,    // → langsung dari pesanan
            'metode'      => $request->metode,
            'bukti'       => $buktiPath,
            'status'      => 'pending',
        ]);

        return redirect()
            ->route('customer.orders.index')
            ->with('success', 'Pembayaran berhasil dikirim, menunggu verifikasi.');
    }
}
