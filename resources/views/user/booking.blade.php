@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8 text-center">
            <h2 class="fw-bold">Booking Service</h2>
            <p class="text-muted">Ambil nomor antrian Anda secara online tanpa perlu datang lebih awal.</p>
        </div>
    </div>

    @if(session('success_booking'))
        <div class="row justify-content-center animate__animated animate__fadeInDown">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg text-center bg-primary text-white">
                    <div class="card-body p-5">
                        <h4 class="fw-normal mb-3">Booking Berhasil!</h4>
                        <p class="opacity-75">Silakan datang sesuai jadwal yang Anda pilih.</p>
                        
                        <div class="bg-white text-dark rounded-3 p-3 d-inline-block my-3 shadow-sm" style="min-width: 200px;">
                            <small class="text-uppercase fw-bold text-muted ls-1">Nomor Antrian Anda</small>
                            <h1 class="display-1 fw-bold text-primary mb-0">
                                {{ session('queue_number') }}
                            </h1>
                            <small class="fw-bold">{{ \Carbon\Carbon::parse(session('booking_date'))->format('d M Y') }}</small>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('booking.index') }}" class="btn btn-outline-light rounded-pill px-4">Buat Booking Baru</a>
                            <a href="{{ route('home') }}" class="btn btn-link text-white text-decoration-none mt-2 d-block">Kembali ke Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-5">
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Nama Pelanggan</label>
                                    <input type="text" name="customer_name" class="form-control bg-light" value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Nomor WhatsApp</label>
                                    <input type="number" name="phone_number" class="form-control bg-light" placeholder="0812..." required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Jenis Motor</label>
                                    <input type="text" name="vehicle_type" class="form-control bg-light" placeholder="Contoh: Vario 150" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Tanggal Service</label>
                                    <input type="date" name="booking_date" class="form-control bg-light" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold small">Keluhan / Catatan</label>
                                    <textarea name="problem_note" class="form-control bg-light" rows="3" placeholder="Jelaskan keluhan motor Anda..."></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3">
                                        AMBIL ANTRIAN
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection