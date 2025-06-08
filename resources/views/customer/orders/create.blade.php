@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Pesanan Baru</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('customer.orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="layanan_id">Pilih Layanan</label>
            <select name="layanan_id" class="form-control" required>
                <option value="">-- Pilih Layanan --</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">
                        {{ $service->nama_layanan }} - Rp{{ number_format($service->harga_per_kg) }}/kg (Estimasi {{ $service->estimasi_hari }} hari)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="berat_kg">Berat (kg)</label>
            <input type="number" name="berat_kg" step="0.1" min="0.5" max="50" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_ambil">Tanggal Ambil</label>
            <input type="date" name="tanggal_ambil" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="catatan">Catatan (Opsional)</label>
            <textarea name="catatan" class="form-control" maxlength="500"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
    </form>
</div>
@endsection
