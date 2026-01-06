@extends('layouts.app')

@section('content')
<style>
    /* Hero Section Dinamis */
    .hero-section {
        /* Mengambil URL gambar dari variabel data yang dikirim Controller */
        background-image: url('{{ $data['hero_image'] }}');
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        
        /* Tinggi banner lebih besar agar lebih dramatis */
        height: 70vh; 
        min-height: 500px;
        
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    /* Overlay yang lebih gelap agar teks putih terbaca jelas */
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.6); /* Tingkat kegelapan 60% */
    }

    /* Container Teks Selogan di Tengah */
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        padding: 20px;
    }

    /* Gaya Judul Selogan Utama */
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    /* Gaya Sub-text Selogan */
    .hero-text {
        font-size: 1.25rem;
        font-weight: 400;
        opacity: 0.9;
        line-height: 1.6;
        font-family: 'Georgia', serif; /* Sentuhan elegan */
    }
</style>

<div class="hero-section">
    <div class="hero-overlay"></div>
    
    <div class="hero-content animate__animated animate__fadeInUp">
        <h1 class="hero-title">
            {{ $data['slogan_title'] }}
        </h1>
        
        <p class="hero-text">
            {{ $data['slogan_text'] }}
        </p>

        <a href="{{ route('booking.index') }}" class="btn btn-primary btn-lg mt-4 rounded-pill px-5 fw-bold">
            <i class="bi bi-calendar-plus me-2"></i> Booking Sekarang
        </a>
    </div>
</div>

<div class="container my-5 py-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold text-dark">{{ $news_setting->title }}</h3>
            <p class="text-muted">{{ $news_setting->description }}</p>
        </div>
    </div>

    <div class="row g-4">
        @foreach($news_items as $item)
        <div class="col-md-6 col-lg-6">
            <div class="card h-100 shadow-sm border-0 overflow-hidden promo-card">

                @php
                    $imgUrl = str_contains($item->image_path, 'http') 
                              ? $item->image_path 
                              : asset('storage/' . $item->image_path);
                @endphp

                <img src="{{ $imgUrl }}" class="card-img-top" alt="{{ $item->title }}" style="height: 250px; object-fit: cover;">

                <div class="card-body p-4">
                    <span class="badge bg-{{ $item->badge_color }} mb-2">{{ $item->badge_text }}</span>
                    <h5 class="card-title fw-bold mb-3">{{ $item->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($item->content, 100) }}</p>
                    <a href="#" class="btn btn-outline-primary btn-sm mt-2 rounded-pill px-4">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection