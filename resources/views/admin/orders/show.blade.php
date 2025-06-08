@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<style>
    body {
        background-color: #f4f6f9;
    }

    .card-custom {
        border: none;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        background: #fff;
        padding: 2rem;
    }

    .title-icon {
        font-size: 1.8rem;
        color: #343a40;
        font-weight: 600;
    }

    .detail-label {
        font-weight: 600;
        color: #6b7280;
    }

    .detail-value {
        font-size: 1rem;
        color: #111827;
    }

    .badge {
        padding: 0.4em 0.7em;
        font-size: 0.75rem;
        border-radius: 0.5rem;
        text-transform: capitalize;
    }

    .badge-menunggu { background-color: #facc15; color: #000; }
    .badge-diproses { background-color: #38bdf8; color: #000; }
    .badge-dicuci { background-color: #3b82f6; color: #fff; }
    .badge-dikeringkan { background-color: #60a5fa; color: #fff; }
    .badge-disetrika { background-color: #93c5fd; color: #000; }
    .badge-siap { background-color: #34d399; color: #000; }
    .badge-selesai { background-color: #10b981; color: #fff; }
    .badge-dibatalkan { background-color: #f87171; color: #fff; }

    .form-select {
        border-radius: 0.5rem;
        max-width: 300px;
    }

    .btn-primary {
        background-color: #2563eb;
        border: none;
        padding: 0.4rem 1rem;
        border-radius: 0.5rem;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }
</style>

<div class="container my-5">
    <div class="card-custom">
        <h2 class="title-icon mb-4">📄 Detail Pesanan</h2>

        <div class="row mb-3">
            <div class="col-md-6">
                <p><span class="detail-label">Nomor Pesanan:</span> <span class="detail-value">{{ $pesanan->nomor_pesanan }}</span></p>
                <p><span class="detail-label">Pelanggan:</span> <span class="detail-value">{{ $pesanan->user->nama ?? 'Tidak diketahui' }}</span></p>
                <p><span class="detail-label">Layanan:</span> <span class="detail-value">{{ $pesanan->layanan->nama_layanan ?? '-' }}</span></p>
                <p><span class="detail-label">Total Harga:</span> <span class="detail-value">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span></p>
            </div>
            <div class="col-md-6">
                <p><span class="detail-label">Status:</span>
                    <span class="badge badge-{{ $pesanan->status }}">{{ ucfirst($pesanan->status) }}</span>
                </p>
                <p><span class="detail-label">Tanggal Ambil:</span> <span class="detail-value">{{ \Carbon\Carbon::parse($pesanan->tanggal_ambil)->format('d-m-Y') }}</span></p>
                <p><span class="detail-label">Tanggal Selesai:</span> <span class="detail-value">{{ $pesanan->tanggal_selesai ? \Carbon\Carbon::parse($pesanan->tanggal_selesai)->format('d-m-Y') : '-' }}</span></p>
            </div>
        </div>

        {{-- Form ubah status --}}
    <form action="{{ route('admin.orders.updateStatus', ['id' => $pesanan->id]) }}" method="POST">



            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="status" class="form-label detail-label">Ubah Status</label>
                <select name="status" id="status" class="form-select">
                    <option disabled selected>Pilih status baru</option>
                    @foreach (['menunggu', 'diproses', 'dicuci', 'dikeringkan', 'disetrika', 'siap', 'selesai', 'dibatalkan'] as $status)
                        <option value="{{ $status }}" {{ $pesanan->status === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="catatan" class="form-label detail-label">Catatan (opsional)</label>
                <textarea name="catatan" id="catatan" rows="2" class="form-control" placeholder="Tulis catatan jika perlu...">{{ old('catatan', $pesanan->catatan) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
