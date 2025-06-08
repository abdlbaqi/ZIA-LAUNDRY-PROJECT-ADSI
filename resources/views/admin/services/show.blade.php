@extends('layouts.app')

@section('title', 'Detail Layanan')

@section('content')
<style>
    .card {
        background: #fff;
        border: none;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    }

    .title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-label {
        font-weight: 500;
        color: #6b7280;
    }

    .detail-value {
        color: #111827;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .badge {
        padding: 6px 10px;
        font-size: 0.75rem;
        border-radius: 20px;
        color: #fff;
    }

    .badge-success { background-color: #22c55e; }
    .badge-secondary { background-color: #9ca3af; }

    .btn-back {
        border-radius: 12px;
    }
</style>

<div class="container my-5">
    <div class="card">
        <div class="title mb-4">
            <i class="bi bi-info-circle-fill"></i> Detail Layanan
        </div>

        <div>
            <div class="detail-label">Nama Layanan</div>
            <div class="detail-value">{{ $service->nama_layanan }}</div>
            <div class="detail-label">Deskripsi</div>
            <div class="detail-value">{{ $service->deskripsi }}</div>

            <div class="detail-label">Harga per Kg</div>
            <div class="detail-value">Rp {{ number_format($service->harga_per_kg, 0, ',', '.') }}</div>

            <div class="detail-label">Estimasi Durasi (hari)</div>
            <div class="detail-value">{{ $service->estimasi_hari }}</div>

            <div class="detail-label">Status</div>
            <div class="detail-value">
                @if($service->aktif)
                    <span class="badge badge-success">Aktif</span>
                @else
                    <span class="badge badge-secondary">Tidak Aktif</span>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-back">← Kembali</a>
        </div>
    </div>
</div>
@endsection
