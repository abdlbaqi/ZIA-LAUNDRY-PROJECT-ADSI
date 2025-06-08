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
</div>
@endsection
