<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer']);
    }

    public function index()
    {
        $user = Auth::user();
        
        $totalOrders = $user->pesanan()->count();

        // Status aktif: semua yang belum selesai/dibatalkan
        $activeOrders = $user->pesanan()
            ->whereIn('status', ['menunggu', 'diproses', 'dicuci', 'dikeringkan', 'disetrika', 'siap'])
            ->count();

        $completedOrders = $user->pesanan()
            ->where('status', 'selesai')
            ->count();
        
        $recentOrders = $user->pesanan()
            ->with('layanan')
            ->latest()
            ->limit(5)
            ->get();

        return view('customer.dashboard', compact(
            'totalOrders',
            'activeOrders',
            'completedOrders',
            'recentOrders'
        ));
    }
}
