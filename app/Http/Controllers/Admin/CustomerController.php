<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // Ambil semua user yang berperan sebagai pelanggan, beserta jumlah pesanannya
       $customers = User::withCount('pesanan')->where('peran', 'pelanggan')->paginate(10);


        return view('admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        // Ambil data pelanggan berdasarkan ID
        $customer = User::with(['pesanan' => function ($query) {
            $query->with('layanan')->latest();
        }])->findOrFail($id);

        return view('admin.customers.show', compact('customer'));
    }
}
