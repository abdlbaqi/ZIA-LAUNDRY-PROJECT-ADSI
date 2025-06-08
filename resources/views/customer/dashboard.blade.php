@extends('layouts.app')

@section('title', 'Dashboard Customer')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
            <p class="text-muted">Selamat datang, {{ Auth::user()->nama }}!</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                    <h4>{{ $totalOrders ?? 0 }}</h4>
                    <p class="mb-0">Total Pesanan</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body text-center">
                    <i class="fas fa-clock fa-2x mb-2"></i>
                    <h4>{{ $activeOrders ?? 0 }}</h4>
                    <p class="mb-0">Pesanan Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <h4>{{ $completedOrders ?? 0 }}</h4>
                    <p class="mb-0">Pesanan Selesai</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-bolt"></i> Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('customer.orders.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> Pesan Laundry
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-list"></i> Lihat Pesanan
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('customer.profile.edit') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-user-edit"></i> Lihat Riwayat Pesanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="fas fa-history"></i> Pesanan Terbaru</h5>
                    <a href="{{ route('customer.orders.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    @if(isset($recentOrders) && $recentOrders->count() > 0)
                        @foreach($recentOrders as $order)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <strong>{{ $order->code }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $order->created_at->format('d/m/Y') }}</small>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>{{ $order->layanan->nama_layanan ?? 'Layanan tidak ditemukan' }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $order->weight }} kg</small>
                                        </div>
                                        <div class="col-md-2">
                                            @php
                                                $statusClass = [
                                                    'pending' => 'warning',
                                                    'processing' => 'info',
                                                    'ready' => 'success',
                                                    'completed' => 'primary',
                                                    'cancelled' => 'danger'
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusClass[$order->status] ?? 'secondary' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada pesanan</p>
                            <a href="{{ route('customer.orders.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Buat Pesanan Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
