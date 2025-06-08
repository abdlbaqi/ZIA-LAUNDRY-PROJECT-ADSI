<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    /**
     * Tampilkan daftar semua pembayaran, beserta relasi user dan pesanan→layanan.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with(['user', 'pesanan.layanan'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    /**
     * Tampilkan detail satu pembayaran, lengkap dengan user dan pesanan→layanan.
     */
    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load(['user', 'pesanan.layanan']);

        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    /**
     * Ubah status pembayaran (verifikasi atau gagal).
     */
    public function updateStatus(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'status' => 'required|in:terverifikasi,gagal',
        ]);

        $pembayaran->status = $request->status;
        $pembayaran->save();

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
