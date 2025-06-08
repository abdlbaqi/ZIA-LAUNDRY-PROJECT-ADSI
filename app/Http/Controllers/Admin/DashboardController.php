<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Layanan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Pesanan::count();
    
        // Sesuaikan status untuk "completed" = 'selesai'
        $completedOrders = Pesanan::where('status', 'selesai')->count();
    
        // Status "processing" kita anggap 'menunggu', 'diproses', 'dicuci', 'dikeringkan', 'disetrika'
        $processingStatuses = ['menunggu', 'diproses', 'dicuci', 'dikeringkan', 'disetrika'];
        $processingOrders = Pesanan::whereIn('status', $processingStatuses)->count();
    
        $totalCustomers = User::where('peran', 'pelanggan')->count();
    
        $recentOrders = Pesanan::with(['user', 'layanan'])
            ->latest()
            ->limit(10)
            ->get();
    
        return view('admin.dashboard', compact(
            'totalOrders',
            'completedOrders', 
            'processingOrders',
            'totalCustomers',
        ));
    }
}    