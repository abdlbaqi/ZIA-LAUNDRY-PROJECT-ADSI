@extends('layouts.app')

@section('title', 'Edit Layanan')

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

    label {
        font-weight: 500;
        color: #374151;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: #6366f1;
        border: none;
        padding: 10px 18px;
        border-radius: 12px;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background: #4f46e5;
    }

    .btn-secondary {
        border-radius: 12px;
    }

    .form-check-label {
        color: #374151;
        margin-left: 8px;
    }
</style>

<div class="container my-5">
    <div class="card">
        <div class="title mb-4">
            <i class="bi bi-pencil-square"></i> Edit Layanan
        </div>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_layanan" class="form-label">Nama Layanan</label>
                <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $service->nama_layanan) }}" required>
            </div>

             <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $service->deskripsi) }}" required>
            </div>

            <div class="mb-3">
                <label for="harga_per_kg" class="form-label">Harga per Kg</label>
                <input type="number" class="form-control" id="harga_per_kg" name="harga_per_kg" value="{{ old('harga_per_kg', $service->harga_per_kg) }}" required>
            </div>

            <div class="mb-3">
                <label for="estimasi_hari" class="form-label">Estimasi Durasi (hari)</label>
                <input type="number" class="form-control" id="estimasi_hari" name="estimasi_hari" value="{{ old('estimasi_hari', $service->estimasi_hari) }}" required>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="aktif" name="aktif" {{ old('aktif', $service->aktif) ? 'checked' : '' }}>
                <label class="form-check-label" for="aktif">Aktif</label>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
