@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-primary text-white fw-bold">
                    Tambah Layanan Baru
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.services.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_layanan" class="form-label">Nama Layanan</label>
                            <input type="text" name="nama_layanan" id="nama_layanan" class="form-control" value="{{ old('nama_layanan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="harga_per_kg" class="form-label">Harga per Kg</label>
                            <input type="number" name="harga_per_kg" id="harga_per_kg" class="form-control" value="{{ old('harga_per_kg') }}" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="estimasi_hari" class="form-label">Estimasi Durasi (hari)</label>
                            <input type="number" name="estimasi_hari" id="estimasi_hari" class="form-control" value="{{ old('estimasi_hari') }}" required>
                        </div>

                        <input type="hidden" name="aktif" value="0" />
<input type="checkbox" name="aktif" value="1" {{ old('aktif') ? 'checked' : '' }} />


                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan Layanan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
