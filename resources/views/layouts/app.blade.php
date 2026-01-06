<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BengkelKita') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Navbar Utama */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); /* Bayangan halus */
            padding: 12px 0; /* Memberi ruang napas */
            transition: all 0.3s;
        }

        /* Logo Brand */
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #1a1a1a !important;
            letter-spacing: -0.5px;
        }
        .navbar-brand i {
            color: #0d6efd; /* Warna biru icon */
        }

        /* Link Menu */
        .nav-link {
            font-weight: 600;
            color: #6c757d !important;
            margin: 0 10px;
            transition: color 0.3s ease, transform 0.2s ease;
            position: relative;
        }

        /* Efek Hover pada Link */
        .nav-link:hover, .nav-link.active {
            color: #0d6efd !important; /* Biru saat disentuh */
            transform: translateY(-1px); /* Sedikit naik */
        }

        /* Dropdown Menu (User) */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 12px;
            padding: 10px;
        }
        .dropdown-item {
            border-radius: 8px;
            padding: 8px 15px;
            font-weight: 500;
        }
        .dropdown-item:hover {
            background-color: #f0f7ff;
            color: #0d6efd;
        }

        /* Tombol Login/Register di Navbar */
        .btn-nav-primary {
            background-color: #0d6efd;
            color: white !important;
            border-radius: 20px;
            padding: 6px 20px;
        }
        .btn-nav-primary:hover {
            background-color: #0b5ed7;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }
    </style>
</head>
<body style="background-color: #f8f9fa;"> <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light navbar-custom sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-wrench-adjustable-circle-fill"></i> Bengkel<span class="text-primary">Kita</span>
                </a>
                
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2"></i> Dashboard
                                    </a>
                                </li>
                    
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.hero.edit') }}">
                                        <i class="bi bi-palette"></i> Tampilan Web
                                    </a>

                                </li>

                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.news.index') }}">
                                <i class="bi bi-newspaper"></i> Kelola Berita
                            </a>
                        </li>
                                                    @else
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                        <i class="bi bi-house-door"></i> Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('booking.index') ? 'active' : '' }}" href="{{ route('booking.index') }}">
                                        <i class="bi bi-calendar-plus"></i> Booking Service
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('booking.history') ? 'active' : '' }}" href="{{ route('booking.history') }}">
                                        <i class="bi bi-clock-history"></i> Riwayat Booking
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn-nav-primary ms-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" 
                                         class="rounded-circle me-1" width="30" height="30" alt="Avatar">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <div class="px-3 py-2 border-bottom mb-2">
                                        <small class="text-muted d-block">Login sebagai:</small>
                                        <span class="badge {{ Auth::user()->role == 'admin' ? 'bg-danger' : 'bg-success' }}">
                                            {{ ucfirst(Auth::user()->role) }}
                                        </span>
                                    </div>
                                    
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person me-2"></i> Profile Saya
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>