@extends('layouts.app')

@section('title', 'Daftar Layanan')

@section('content')
<style>
    body {
        background-color: #f3f4f6;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
        background: #fff;
        border: none;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    }

    .title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-add {
        background: #6366f1;
        border: none;
        color: #fff;
        padding: 10px 18px;
        border-radius: 12px;
        transition: background 0.3s ease;
    }

    .btn-add:hover {
        background: #4f46e5;
    }

    .alert {
        border-radius: 10px;
        padding: 12px;
    }

    .table {
        border-radius: 12px;
        overflow: hidden;
    }

    .table th {
        background-color: #f9fafb;
        color: #6b7280;
        font-weight: 600;
    }

    .table td {
        vertical-align: middle;
        color: #374151;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.85rem;
        border-radius: 8px;
    }

    .btn-info { background: #0ea5e9; border: none; color: #fff; }
    .btn-info:hover { background: #0284c7; }

    .btn-warning { background: #fbbf24; border: none; color: #111827; }
    .btn-warning:hover { background: #f59e0b; }

    .btn-danger { background: #ef4444; border: none; }
    .btn-danger:hover { background: #dc2626; }

    .badge {
        padding: 6px 10px;
        font-size: 0.75rem;
        border-radius: 20px;
        color: #fff;
    }

    .badge-success { background-color: #22c55e; }
    .badge-secondary { background-color: #9ca3af; }

    .text-muted { color: #9ca3af !important; }
</style>

<div class="container my-5">
    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="title">
                <i class="bi bi-gear-fill"></i> Daftar Layanan
            </div>
            <a href="{{ route('admin.services.create') }}" class="btn btn-add">
                + Tambah Layanan
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Durasi (hari)</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->nama_layanan }}</td>
                            <td>{{ $service->deskripsi }}</td>
                            <td>Rp {{ number_format($service->harga_per_kg, 0, ',', '.') }}</td>
                            <td>{{ $service->estimasi_hari }}</td>
                            <td>
                                @if($service->aktif)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.services.show', $service->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">Belum ada layanan tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
