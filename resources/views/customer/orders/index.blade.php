@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container">
    <h1>Daftar Pesanan</h1>

    <form method="GET" action="{{ route('customer.orders.index') }}" class="mb-3">
        <label for="status">Filter Status:</label>
        <select name="status" id="status" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
            <option value="">Semua</option>
            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
        </select>
    </form>

    @if ($orders->count())
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nomor Pesanan</th>
                <th>Layanan</th>
                <th>Berat (kg)</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal Ambil</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->nomor_pesanan }}</td>
                <td>{{ $order->layanan->nama_layanan }}</td>
                <td>{{ $order->berat_kg }}</td>
                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ \Carbon\Carbon::parse($order->tanggal_ambil)->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-primary btn-sm">Detail</a>
                    <a href="{{ route('customer.pembayaran.create', $order->id) }}" class="btn btn-primary btn-sm ">Bayar Sekarang</a>
                    <form action="{{ route('customer.orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->withQueryString()->links() }}
    @else
    <p>Tidak ada pesanan ditemukan.</p>
    @endif

    <a href="{{ route('customer.orders.create') }}" class="btn btn-success mt-3">Buat Pesanan Baru</a>
</div>
@endsection
