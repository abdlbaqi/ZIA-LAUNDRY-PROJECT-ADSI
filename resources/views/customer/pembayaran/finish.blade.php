@extends('layouts.app')

@section('title', 'Pembayaran Sukses')

@section('content')
<div class="container mt-5 text-center">
    <div class="card shadow-lg p-4">
        <h2 class="text-success">🎉 Pembayaran Berhasil!</h2>
        <p class="mt-3">Terima kasih! Pembayaran Anda telah berhasil diproses.</p>

        <div class="mt-4">
            <a href="{{ route('customer.orders.index') }}" class="btn btn-primary">
                Lihat Status Pesanan
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
