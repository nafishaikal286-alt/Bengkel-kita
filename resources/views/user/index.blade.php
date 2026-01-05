@extends('layouts.app')

@section('content')
<style>
    /* Hero Section dengan Gambar Background */
    .hero-section {
        background: url('https://images.unsplash.com/photo-1599256621730-d3269650226e?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
        background-size: cover;
        height: 500px; /* Tinggi banner di desktop */
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Overlay gelap agar teks/kotak lebih kontras */
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4);
    }

    /* Kotak Pencarian (Location & Date) */
    .booking-widget {
        position: relative;
        z-index: 2;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        max-width: 800px;
        width: 90%;
    }

    /* Teks Intro yang elegan (Serif) */
    .intro-text {
        font-family: 'Georgia', serif; /* Meniru font di gambar */
        color: #555;
        line-height: 1.8;
        font-size: 1.1rem;
    }

    /* Tombol Learn More (Warna Slate Grey/Biru Pucat sesuai gambar) */
    .btn-slate {
        background-color: #8391a1; /* Warna mirip gambar */
        color: white;
        border: none;
        padding: 10px 25px;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-slate:hover {
        background-color: #6c7a89;
        color: white;
    }

    /* Card Styling */
    .promo-card img {
        height: 200px;
        object-fit: cover;
    }
</style>

<div class="hero-section">
    <div class="hero-overlay"></div>
    
    <div class="booking-widget" id="booking-area">
        <form action="{{ route('booking.store') }}" method="POST"> <div class="row align-items-center">
                <div class="col-md-5 mb-3 mb-md-0 border-end">
                    <label class="text-uppercase text-muted small fw-bold mb-1">
                        <i class="bi bi-geo-alt-fill text-primary"></i> Location
                    </label>
                    <select class="form-select border-0 fw-bold shadow-none" style="padding-left:0;">
                        <option>Sleman Sembada</option>
                        <option>Jakarta Selatan</option>
                        <option>Bandung Kota</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3 mb-md-0 border-end">
                    <label class="text-uppercase text-muted small fw-bold mb-1">
                        <i class="bi bi-calendar-event text-primary"></i> Date
                    </label>
                    <input type="date" class="form-control border-0 fw-bold shadow-none" style="padding-left:0;" value="2025-07-12">
                </div>

                <div class="col-md-3 text-center">
                    <button type="submit" class="btn btn-dark w-100 py-2">
                        Booking Now
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center text-center mb-5">
        <div class="col-lg-8">
            <h2 class="mb-4 fw-bold">Selamat Datang di BengkelKita</h2>
            <p class="intro-text">
                Merawat motor kini jadi lebih mudah bersama BengkelKita! 
                Tinggal booking, pilih jadwal, datang — motor langsung ditangani 
                mekanik profesional tanpa harus menunggu lama. Praktis, cepat, terpercaya!
            </p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-6">
            <div class="card h-100 shadow-sm border-0 overflow-hidden promo-card">
                <img src="https://images.unsplash.com/photo-1625043484555-47841a750399?q=80&w=2070&auto=format&fit=crop" class="card-img-top" alt="Bengkel Bersih">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">10 Nominasi Bengkel Terbaik di Indonesia</h5>
                    <p class="card-text text-muted">Kami masuk dalam jajaran bengkel dengan pelayanan terbaik dan peralatan terlengkap tahun ini.</p>
                    <a href="#" class="btn btn-slate mt-2">Learn More</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="card h-100 shadow-sm border-0 overflow-hidden promo-card">
                <img src="https://images.unsplash.com/photo-1487800940032-1cf21118ccde?q=80&w=2069&auto=format&fit=crop" class="card-img-top" alt="Service Motor">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">Layanan Gratis Service Akhir Tahun</h5>
                    <p class="card-text text-muted">Dapatkan pengecekan ringan gratis untuk persiapan liburan akhir tahun Anda. Khusus member.</p>
                    <a href="#" class="btn btn-slate mt-2">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection