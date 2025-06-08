@extends('layouts.app')

@section('title', 'Layanan Laundry')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Jenis Layanan Kami</h2>

    <div class="row g-4">
        @foreach($layanans as $layanan)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4 hover-shadow">
                <div class="card-body text-center">
                    <i class="fas fa-tshirt fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">{{ $layanan->nama_layanan }}</h5>
                    <p class="text-muted">{{ $layanan->deskripsi }}</p>
                    <p class="fw-semibold text-success">Rp{{ number_format($layanan->harga_per_kg, 0, ',', '.') }}</p>
                    <a href="{{route('customer.orders.create')}}" class="btn btn-outline-primary btn-sm">Pesan Sekarang</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
        transform: translateY(-4px);
        transition: 0.3s ease-in-out;
    }
</style>
@endsection
