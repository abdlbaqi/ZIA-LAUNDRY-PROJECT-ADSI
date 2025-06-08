@extends('layouts.app')

@section('title', 'Detail Layanan')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Detail Layanan</h1>

    <div class="card">
        <div class="card-body">
        <h3 class="card-title">{{ $order->layanan->nama_layanan ?? 'Layanan tidak ditemukan' }}</h3>

<p><strong>Deskripsi:</strong><br>
    {{ $order->layanan->deskripsi ?? 'Tidak ada deskripsi.' }}
</p>

<p><strong>Harga per Kg:</strong> 
    Rp{{ number_format($order->layanan->harga_per_kg ?? 0) }}
</p>

<p><strong>Estimasi Hari:</strong> 
    {{ $order->layanan->estimasi_hari ?? '-' }} hari
</p>

<p><strong>Status:</strong>
    @if ($order->layanan && $order->layanan->aktif)
        <span class="badge bg-success">Aktif</span>
    @else
        <span class="badge bg-secondary">Tidak Aktif</span>
    @endif
</p>

<p><strong>Dibuat pada:</strong> 
    {{ $order->layanan->created_at ? $order->layanan->created_at->format('d M Y - H:i') : '-' }}
</p>

<p><strong>Diperbarui pada:</strong> 
    {{ $order->layanan->updated_at ? $order->layanan->updated_at->format('d M Y - H:i') : '-' }}
</p>


<div class="mt-4">
    <a href="{{ route('customer.orders.create') }}" class="btn btn-success">Buat Pesanan</a>
    <a href="{{ route('customer.orders.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@endsection