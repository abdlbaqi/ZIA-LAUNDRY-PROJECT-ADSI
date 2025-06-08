<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

   public function index()
    {

    $pesanans = Pesanan::with(['user', 'layanan'])
                ->latest()
                ->paginate(15);


        $totalHarga = $pesanans->sum('totalHarga');
    return view('admin.orders.index', compact('pesanans', 'totalHarga'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'layanan'])->findOrFail($id);
    return view('admin.orders.show', compact('pesanan'));
    }

 public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:menunggu,diproses,dicuci,dikeringkan,disetrika,siap,selesai,dibatalkan',
        'catatan' => 'nullable|string|max:500',
    ]);

    $pesanan = Pesanan::findOrFail($id); // manual ambil data

    $pesanan->update([
        'status' => $request->status,
        'catatan' => $request->catatan,
    ]);

    if ($request->status === 'selesai') {
        $pesanan->update(['tanggal_selesai' => now()]);
    }

    return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
}


public function destroy($id){
  $pesanan = Pesanan::findOrFail($id); // cari data berdasarkan ID
    $pesanan->delete(); // hapus data

    return redirect()->route('admin.orders.index')
                     ->with('success', 'Pesanan berhasil dihapus.');
}
}