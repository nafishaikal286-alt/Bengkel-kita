<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Data ini nantinya diambil dari database (Tabel Settings/Konfigurasi)
        $data = [
        // Foto Background Pilihan Admin
        'hero_image' => 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?q=80&w=2072&auto=format&fit=crop',
        // Selogan Pilihan Admin
        'slogan_title' => 'Performa Maksimal, Perjalanan Tanpa Kendala.',
        'slogan_text' => 'Serahkan perawatan kendaraan Anda pada ahlinya. Cepat, Tepat, dan Terpercaya.'
    ];

    return view('user.index', compact('data'));
 
    }
}
