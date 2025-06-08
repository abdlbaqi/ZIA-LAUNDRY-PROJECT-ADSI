@extends('layouts.app')

@section('title', 'Login - Laundry App')

@section('content')
<style>
    body {
        background-color: #1e2a38;
        font-family: 'Poppins', sans-serif;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .login-card {
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

    .login-image {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        flex: 1;
        overflow: hidden;
    }

    .login-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .form-section {
        flex: 1;
        padding: 2.5rem;
    }

    .form-section h3 {
        font-weight: 600;
        color: #ffffff;
    }

    .form-section p {
        color: #cfd8dc;
    }

    .form-control {
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
    }

    .form-check-label {
        color: #b0bec5;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    a.text-primary {
        color: #66b2ff !important;
    }

    @media (max-width: 768px) {
        .login-card {
            flex-direction: column;
        }

        .login-image {
            display: none;
        }
    }
</style>

<div class="container login-container">
    <div class="login-card">
        
        <!-- Gambar Kiri -->
        <div class="login-image">
            <img src="https://i.pinimg.com/736x/fb/e5/30/fbe53021cdd6018f6f6d2759f339614f.jpg" alt="Laundry Illustration">
        </div>

        <!-- Form Kanan -->
        <div class="form-section">
            <div class="mb-4 text-center">
                <h3>Login</h3>
                <p>Masuk ke akun Laundry App Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label text-light">Email</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                          
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-light">Password</label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                          
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2">Masuk</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="mb-0">Belum punya akun?
                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
