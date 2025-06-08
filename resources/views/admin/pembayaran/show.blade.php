@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="container my-5">
    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary btn-sm mb-4">
        &larr; Kembali ke Daftar Pembayaran
    </a>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Detail Pembayaran #{{ $pembayaran->id }}</h5>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">User</dt>
                <dd class="col-sm-9">{{ $pembayaran->user->nama }} ({{ $pembayaran->user->email }})</dd>

                <dt class="col-sm-3">Layanan</dt>
                <dd class="col-sm-9">{{ $pembayaran->pesanan->layanan->nama_layanan }}</dd>

                <dt class="col-sm-3">Total Harga</dt>
                <dd class="col-sm-9">
                    Rp {{ number_format($pembayaran->total_harga, 0, ',', '.') }}
                </dd>

                <dt class="col-sm-3">Metode Pembayaran</dt>
                <dd class="col-sm-9">{{ $pembayaran->metode }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    @if($pembayaran->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($pembayaran->status === 'terverifikasi')
                        <span class="badge bg-success">Terverifikasi</span>
                    @else
                        <span class="badge bg-danger">Gagal</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Waktu Kirim</dt>
                <dd class="col-sm-9">{{ $pembayaran->created_at->format('d M Y H:i:s') }}</dd>

                <dt class="col-sm-3">Bukti Transfer</dt>
                <dd class="col-sm-9">
                    @if($pembayaran->bukti)
                        <a href="{{ asset('storage/'.$pembayaran->bukti) }}" 
                           target="_blank" class="btn btn-sm btn-outline-primary">
                            Lihat Bukti
                        </a>
                    @else
                        <span class="text-muted">Tidak ada bukti</span>
                    @endif
                </dd>
            </dl>
        </div>
        <div class="card-footer text-end">
            @if($pembayaran->status === 'pending')
                <form action="{{ route('admin.pembayaran.updateStatus', $pembayaran->id) }}" 
                      method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="terverifikasi">
                    <button class="btn btn-success btn-sm me-2"
                            onclick="return confirm('Verifikasi pembayaran ini?')">
                        Verifikasi
                    </button>
                </form>
                <form action="{{ route('admin.pembayaran.updateStatus', $pembayaran->id) }}" 
                      method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="gagal">
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Tandai pembayaran ini sebagai gagal?')">
                        Gagal
                    </button>
                </form>
            @else
                <span class="text-muted">Tidak ada tindakan yang tersedia.</span>
            @endif
        </div>
    </div>
</div>
@endsection
