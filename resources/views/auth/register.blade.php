@extends('layouts.app')

@section('content')
<style>
    main { padding: 0 !important; }
    
    .register-container {
        min-height: calc(100vh - 70px);
    }
    
    .register-image {
        /* Gambar berbeda untuk register */
        background: url('https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
        background-size: cover;
        position: relative;
    }
    
    .form-section {
        background-color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-wrapper {
        width: 100%;
        max-width: 450px; /* Sedikit lebih lebar karena inputnya banyak */
        padding: 20px;
    }

    .form-control {
        padding: 12px;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
    }
    .form-control:focus {
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }
</style>

<div class="container-fluid p-0">
    <div class="row g-0 register-container">
        
        <div class="col-lg-5 form-section order-2 order-lg-1">
            <div class="form-wrapper">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark">Buat Akun Baru</h3>
                    <p class="text-muted">Bergabunglah dengan BengkelKita sekarang.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama Anda">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@email.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-uppercase">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-uppercase">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" required id="terms">
                        <label class="form-check-label small text-muted" for="terms">
                            Saya menyetujui <a href="#" class="text-decoration-none">Syarat & Ketentuan</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm">
                        DAFTAR SEKARANG
                    </button>

                    <div class="text-center mt-4">
                        <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-primary text-decoration-none">Login disini</a></p>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7 d-none d-lg-block register-image order-1 order-lg-2">
            <div style="background: rgba(0,0,0,0.3); position:absolute; top:0; left:0; width:100%; height:100%;"></div>
            <div class="d-flex align-items-end h-100 p-5 position-relative text-white" style="z-index: 2;">
                <div class="text-end w-100">
                    <h2 class="fw-bold display-6">Siap Merawat Kendaraan?</h2>
                    <p class="lead mb-0">Daftar sekarang dan nikmati kemudahan booking service tanpa antri.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection