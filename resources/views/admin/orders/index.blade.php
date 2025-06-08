@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<style>
    /* Styles sama seperti yang kamu buat */
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

    .filter-label {
        font-weight: 500;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        border-radius: 0.5rem;
    }

    .btn-primary {
        background-color: #2563eb;
        border: none;
        padding: 0.5rem 1.2rem;
        border-radius: 0.5rem;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .btn-info {
        background-color: #0ea5e9;
        border: none;
    }

    .btn-info:hover {
        background-color: #0284c7;
    }

    .badge {
        padding: 0.4em 0.7em;
        font-size: 0.75rem;
        border-radius: 0.5rem;
        text-transform: capitalize;
    }

    /* Warna badge sesuai status */
    .badge-menunggu { background-color: #facc15; color: #000; }
    .badge-diproses { background-color: #38bdf8; color: #000; }
    .badge-dicuci { background-color: #3b82f6; color: #fff; }
    .badge-dikeringkan { background-color: #60a5fa; color: #fff; }
    .badge-disetrika { background-color: #93c5fd; color: #000; }
    .badge-siap { background-color: #34d399; color: #000; }
    .badge-selesai { background-color: #10b981; color: #fff; }
    .badge-dibatalkan { background-color: #f87171; color: #fff; }
</style>

<div class="container my-5">
    <div class="card-custom">
        <h2 class="title-icon mb-4">📦 Daftar Pesanan</h2>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nomor Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Total harga</th>
                        <th>Status</th>
                        <th>Tanggal Buat</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanans as $pesanan)
                        <tr>
                            <td>{{ $pesanan->nomor_pesanan }}</td>
                            <td>{{ $pesanan->user->nama }}</td>
                            <td>{{ $pesanan->layanan->nama_layanan ?? '-' }}</td>
                             <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-{{ $pesanan->status }}">
                                    {{ ucfirst($pesanan->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_ambil)->format('d-m-Y') }}</td>
                            <td>{{ $pesanan->tanggal_selesai ? \Carbon\Carbon::parse($pesanan->tanggal_selesai)->format('d-m-Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $pesanan->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <form action="{{ route('admin.orders.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
</form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $pesanans->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
