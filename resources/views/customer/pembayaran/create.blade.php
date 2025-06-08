@extends('layouts.app')

@section('title', 'Pembayaran Pesanan')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">
        Pembayaran untuk Pesanan #{{ $pesanan->id }} (Total: 
        Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }})
    </h3>

    <form action="{{ route('customer.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pesanan_id" value="{{ $pesanan->id }}">

        <div class="mb-3">
            <label for="metode" class="form-label">Metode Pembayaran</label>
            <select name="metode" id="metode" class="form-select" required>
                <option value="" selected disabled>-- Pilih Metode --</option>
                <option value="bank">Transfer Bank (BCA)</option>
                <option value="dana">Dana</option>
                <option value="ovo">OVO</option>
                <option value="cod">Bayar Di Toko (COD)</option>
            </select>
        </div>

        {{-- Zona QR code --}}
        <div class="mb-4" id="qr-container" style="display: none;">
            <p class="mb-2"><strong>Silakan scan QR berikut:</strong></p>

            {{-- QR Transfer Bank --}}
            <div class="qr-item" data-metode="bank" style="display: none;">
                <img src="{{ asset('images/qr/bank_bca.png') }}" 
                     alt="QR Transfer Bank BCA" 
                     class="img-fluid mb-3"
                     style="max-width: 250px;">
                <p class="small text-muted">Scan untuk Transfer ke Rekening BCA</p>
            </div>

            {{-- QR Dana --}}
            <div class="qr-item" data-metode="dana" style="display: none;">
                <img src="{{ asset('imges/qr/dana.jpg') }}" 
                     alt="QR Dana" 
                     class="img-fluid mb-3"
                     style="max-width: 400px;">
                <p class="small text-muted">Scan untuk Pembayaran via Dana</p>
            </div>

            {{-- QR OVO --}}
            <div class="qr-item" data-metode="ovo" style="display: none;">
                <img src="{{ asset('images/qr/ovo.png') }}" 
                     alt="QR OVO" 
                     class="img-fluid mb-3"
                     style="max-width: 250px;">
                <p class="small text-muted">Scan untuk Pembayaran via OVO</p>
            </div>

            {{-- Bayar Di Toko (tidak butuh QR) --}}
            <div class="qr-item" data-metode="cod" style="display: none;">
                <p class="text-muted">Pilih “Bayar Di Toko” untuk membayar langsung saat mengambil pesanan.</p>
            </div>
        </div>
        {{-- /Zona QR code --}}

        <div class="mb-3">
            <label for="bukti" class="form-label">Upload Bukti Pembayaran (optional)</label>
            <input type="file" name="bukti" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pembayaran</button>
    </form>
</div>

{{-- Script untuk menampilkan QR sesuai metode --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const metodeSelect = document.getElementById('metode');
    const qrContainer = document.getElementById('qr-container');
    const qrItems = document.querySelectorAll('.qr-item');

    metodeSelect.addEventListener('change', function () {
        const selected = this.value;

        // Jika belum pilih atau pilih COD, tampilkan container tetapi item COD saja atau hide semua
        if (selected) {
            qrContainer.style.display = 'block';
        } else {
            qrContainer.style.display = 'none';
        }

        qrItems.forEach(item => {
            if (item.getAttribute('data-metode') === selected) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endpush
@endsection
