@extends('layouts.app')

@section('content')
<h2>Bayar Pesanan #{{ $pembayaran->id }}</h2>

<p><strong>Total Harga:</strong> Rp{{ number_format($pembayaran->total_harga, 0, ',', '.') }}</p>

<p><strong>Metode:</strong> {{ ucfirst($pembayaran->metode) }}</p>

<button id="pay-button" class="btn btn-primary mt-3">Bayar Sekarang</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.clientKey') }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $pembayaran->snap_token }}', {
            onSuccess: function(result){
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('customer.orders.index') }}";
            },
            onPending: function(result){
                alert("Pembayaran sedang diproses.");
            },
            onError: function(result){
                alert("Pembayaran gagal!");
            },
            onClose: function(){
                alert("Anda menutup popup pembayaran.");
            }
        });
    });
</script>

@endsection
