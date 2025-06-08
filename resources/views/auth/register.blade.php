@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<style>
    body {
        background-color: #1e2a38;
        font-family: 'Poppins', sans-serif;
    }

    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .register-card {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: row;
        width: 100%;
        max-width: 900px;
        background-color: #2d3e50;
        color: #f8f9fa;
    }

    /* LEFT BANNER sebagai background image yang cover */
    .left-banner {
        background: url('https://i.pinimg.com/736x/fb/e5/30/fbe53021cdd6018f6f6d2759f339614f.jpg') no-repeat center center;
        background-size: cover; /* Cover supaya fit dan memenuhi area */
        background-color: #0d6efd;
        flex: 1;
        border-radius: 1rem 0 0 1rem;
        /* Hapus padding agar background memenuhi penuh */
        display: block; /* cukup block, tanpa flex agar gambar full */
        min-height: auto;
        position: relative;
    }

    /* Hapus tag img di dalam left-banner, atau jika ingin pakai img, atur agar fit */
    .left-banner img {
        display: none; /* hide karena kita pakai background image */
    }

    .form-section {
        flex: 1;
        padding: 2.5rem;
    }

    .form-section h2 {
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .form-section p {
        color: #cfd8dc;
        margin-bottom: 2rem;
    }

    .form-control, textarea.form-control {
        background-color: #435a6b;
        border: none;
        color: #fff;
    }

    .form-control::placeholder {
        color: #b0bec5;
    }

    .form-control:focus {
        background-color: #546e7a;
        color: #fff;
        box-shadow: none;
    }

    .text-danger {
        color: #ff6b6b !important;
    }

    .btn-success {
        background-color: #0d6efd;
        border: none;
    }

    .btn-success:hover {
        background-color: #0b5ed7;
    }

    a.text-success {
        color: #66b2ff !important;
    }

    .alert-danger {
        background-color: #b71c1c;
        color: #fff;
        border: none;
    }

    @media (max-width: 768px) {
        .register-card {
            flex-direction: column;
        }

        .left-banner {
            display: none;
        }
    }
</style>

<div class="container register-container">
    <div class="register-card">
        <!-- Left Image / Banner -->
        <div class="left-banner">
            {{-- Jika mau pakai gambar SVG tambahan, bisa di sini. Kalau tidak, hapus tag <img> --}}
            {{-- <img src="https://undraw.co/api/illustrations/cleaning-team.svg" alt="Laundry Illustration"> --}}
        </div>

        <!-- Right Form -->
        <div class="form-section">
            <div class="text-center">
                <h2><i class="fas fa-user-plus text-primary me-2"></i>Buat Akun</h2>
                <p>Daftarkan dirimu untuk menikmati layanan laundry kami</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <input type="text" name="nama" id="nama" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           placeholder="Nama Lengkap" 
                           value="{{ old('nama') }}" 
                           required>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="email" name="email" id="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           placeholder="Email" 
                           value="{{ old('email') }}" 
                           required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="text" name="telepon" id="telepon" 
                           class="form-control @error('telepon') is-invalid @enderror" 
                           placeholder="Nomor Telepon" 
                           value="{{ old('telepon') }}" 
                           required>
                    @error('telepon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <textarea name="alamat" id="alamat" 
                              class="form-control @error('alamat') is-invalid @enderror" 
                              placeholder="Alamat" 
                              style="height: 100px" 
                              required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" name="password" id="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Password" 
                           required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="form-control" 
                           placeholder="Konfirmasi Password" 
                           required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-user-plus me-2"></i> Daftar
                    </button>
                </div>

                <div class="text-center">
                    <small class="text-muted">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-success text-decoration-none">Login di sini</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
