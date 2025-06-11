<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Midtrans\Snap;
use Midtrans\Config;

class PembayaranController extends Controller
{
    public function bayar($orderId)
    {
        $pesanan = Pesanan::with(['layanan', 'user'])->findOrFail($orderId);

        // Midtrans Configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $pesanan->nomor_pesanan,
                'gross_amount' => $pesanan->total_harga,
            ],
            'customer_details' => [
                'first_name' => $pesanan->user->name,
                'email' => $pesanan->user->email,
            ],

                'callbacks' => [
            'finish' => route('customer.pembayaran.finish'),
            'unfinish' => route('customer.pembayaran.unfinish'),
            'error' => route('customer.pembayaran.error'),
                ],
        ];

        try {
            // Buat snap token
            $snapToken = Snap::getSnapToken($params);

            // Simpan token ke database
           Pembayaran::create([
    'user_id'     => auth()->id(),
    'pesanan_id'  => $pesanan->id,
    'total_harga' => $pesanan->total_harga,
    'metode'      => 'Midtrans',
    'status'      => 'pending',
    'snap_token'  => $snapToken, // ← ini penting
]);


            return redirect()->route('customer.orders.index')->with('success', 'Token pembayaran berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat token pembayaran: ' . $e->getMessage());
        }
    }
    public function finish(Request $request)
{
    return view('customer.pembayaran.finish');
}


public function show($id)
{
    $pesanan = Pesanan::where('id', $id)
                  ->where('user_id', auth()->id())
                  ->firstOrFail();

    $pembayaran = Pembayaran::where('pesanan_id', $pesanan->id)->firstOrFail();

    return view('customer.pembayaran.show', compact('pembayaran'));
}


}
