@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Detail Pelanggan</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $customer->nama }}</h5>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Telepon:</strong> {{ $customer->telepon }}</p>
            <p><strong>Alamat:</strong> {{ $customer->alamat }}</p>
            <p><strong>Total Pesanan:</strong> {{ $customer->pesanan->count() }}</p>
        </div>
    </div>

    <h5>Daftar Pesanan</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Kode Pesanan</th>
                    <th>Status</th>
                    <th>Layanan</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customer->pesanan as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->nomor_pesanan }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @if ($order->layanan)
                                {{ $order->layanan->nama_layanan }} <br>
                                <small class="text-muted">Rp{{ number_format($order->layanan->harga_per_kg, 0, ',', '.') }}</small>
                            @else
                                <span class="text-muted">Tidak ada layanan</span>
                            @endif
                        </td>
                        <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary mt-3">← Kembali ke Daftar</a>
</div>
@endsection
