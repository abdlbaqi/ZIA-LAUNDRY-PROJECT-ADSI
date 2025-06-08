<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer']);
    }

    public function index(Request $request)
    {
        $query = Auth::user()->pesanan()->with('layanan');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function create()
    {
        $services = Layanan::where('aktif', true)->get();
        return view('customer.orders.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'layanan_id' => 'required|exists:layanan,id',
            'berat_kg' => 'required|numeric|min:0.5|max:50',
            'tanggal_ambil' => 'required|date|after_or_equal:today',
            'catatan' => 'nullable|string|max:500',
        ]);

        $layanan = Layanan::findOrFail($request->layanan_id);

        if (!$layanan->aktif) {
            return redirect()->back()
                ->with('error', 'Layanan yang dipilih tidak tersedia.');
        }

     $totalHarga = $layanan->harga_per_kg * $request->berat_kg;
     $tanggalSelesai = now()->addDays($layanan->estimasi_hari);


        $order = Pesanan::create([
            'nomor_pesanan' => $this->generateOrderCode(),
            'user_id' => Auth::id(),
            'layanan_id' => $request->layanan_id,
            'berat_kg' => $request->berat_kg,
            'total_harga' => $totalHarga,
            'tanggal_ambil' => $request->tanggal_ambil,
            'tanggal_selesai' => $tanggalSelesai,
            'catatan' => $request->catatan,
            'status' => 'menunggu',
        ]);

        return redirect()->route('customer.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat. Silakan tunggu konfirmasi dari admin.');
    }

    public function show(Pesanan $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['layanan', 'user']);
        return view('customer.orders.show', compact('order'));
    }

    private function generateOrderCode()
    {
        $date = now()->format('Ymd');
        $lastOrder = Pesanan::whereDate('created_at', today())->latest()->first();

        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->nomor_pesanan, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '1';
        }

        return 'LD' . $date . $newNumber;
    }

    public function destroy(Pesanan $order){

    $order->delete(); // hapus data

    return redirect()->route('customer.orders.index')
                     ->with('success', 'Pesanan berhasil dihapus.');
    }
    
}
