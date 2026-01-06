@extends('layouts.app')

@section('content')
<style>
    /* Hilangkan padding default dari main layout agar full screen */
    main { padding: 0 !important; }
    
    .login-container {
        min-height: calc(100vh - 70px); /* Tinggi layar dikurangi tinggi navbar */
    }
    
    .login-image {
        background: url('https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=1974&auto=format&fit=crop') no-repeat center center;
        background-size: cover;
        position: relative;
    }
    
    .login-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(13, 110, 253, 0.2); /* Overlay biru tipis */
    }

    .form-section {
        background-color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-wrapper {
        width: 100%;
        max-width: 400px;
        padding: 20px;
    }

    .form-control {
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        background-color: #f8f9fa;
    }
    .form-control:focus {
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }
</style>

<div class="container-fluid p-0">
    <div class="row g-0 login-container">
        <div class="col-lg-7 d-none d-lg-block login-image">
            <div class="login-overlay"></div>
            <div class="d-flex align-items-end h-100 p-5 position-relative text-white" style="z-index: 2;">
                <div>
                    <h2 class="fw-bold display-6">Selamat Datang Kembali!</h2>
                    <p class="lead mb-0">Kelola servis kendaraan Anda dengan mudah dan cepat bersama BengkelKita.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-5 form-section">
            <div class="form-wrapper">
                <div class="text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-person-fill fs-3"></i>
                    </div>
                    <h3 class="fw-bold">Login Akun</h3>
                    <p class="text-muted">Masuk untuk mengakses layanan.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small text-uppercase">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nama@email.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="password" class="form-label fw-bold small text-uppercase">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted" for="remember">
                            Ingat Saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm">
                        MASUK SEKARANG
                    </button>

                    <div class="text-center mt-4">
                        <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Daftar disini</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection