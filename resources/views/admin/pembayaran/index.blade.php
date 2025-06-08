@extends('layouts.app') {{-- misal layout admin-nya di layouts/admin.blade.php --}}

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Pembayaran</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Layanan</th>
                    <th>Metode</th>
                    <th>Total Harga</th>
                    <th>Waktu Kirim</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayarans as $idx => $p)
                    <tr>
                        <td>{{ $pembayarans->firstItem() + $idx }}</td>
                        <td>{{ $p->user->nama }}</td>
                        <td>{{ $p->pesanan->layanan->nama_layanan }}</td>
                        <td>{{ $p->metode }}</td>
                      <td>
    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
</td>


                        <td>{{ $p->created_at->format('d M Y H:i') }}</td>
                        <td>
                            @if($p->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($p->status === 'terverifikasi')
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-danger">Gagal</span>
                            @endif
                        </td>
                        <td>
                            @if($p->bukti)
                                <a href="{{ asset('storage/'.$p->bukti) }}" target="_blank">Lihat Bukti</a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.pembayaran.show', $p->id) }}" 
                               class="btn btn-info btn-sm mb-1">Detail</a>

                            @if($p->status === 'pending')
                                <form action="{{ route('admin.pembayaran.updateStatus', $p->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="terverifikasi">
                                    <button class="btn btn-success btn-sm mb-1"
                                            onclick="return confirm('Verifikasi pembayaran ini?')">
                                        Verifikasi
                                    </button>
                                </form>
                                <form action="{{ route('admin.pembayaran.updateStatus', $p->id) }}" 
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
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-muted">Belum ada data pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $pembayarans->links() }}
    </div>
</div>
@endsection
