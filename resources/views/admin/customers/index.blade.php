@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Daftar Pelanggan</h1>

    <form method="GET" action="{{ route('admin.customers.index') }}" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama/email/telepon..." value="{{ request('cari') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Total Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $index => $user)
                    <tr>
                        <td>{{ $customers->firstItem() + $index }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telepon }}</td>
                        <td>{{ $user->alamat }}</td>
                        <td>{{ $user->pesanan_count }}</td>
                        <td>
                            <a href="{{ route('admin.customers.show', $user->id) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pelanggan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $customers->withQueryString()->links() }}
    </div>
</div>
@endsection
