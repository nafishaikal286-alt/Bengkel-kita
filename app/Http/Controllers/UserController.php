<?php

namespace App\Http\Controllers;
use App\Models\HeroSetting; // Import Model
use App\Models\NewsSetting;
use App\Models\NewsItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada di paling atas





use Illuminate\Http\Request;

class UserController extends Controller
{

public function index()
{
    // Ambil data settingan dari database
    $setting = HeroSetting::first();

    // Olah URL gambar (Cek apakah link luar atau file storage lokal)
    $bgImage = $setting->hero_image;
    if (!str_contains($bgImage, 'http')) {
        $bgImage = asset('storage/' . $bgImage);
    }

    // Masukkan ke array data seperti struktur sebelumnya
    $data = [
        'hero_image' => $bgImage,
        'slogan_title' => $setting->slogan_title,
        'slogan_text' => $setting->slogan_text
    ];

   $news_setting = NewsSetting::first();
    $news_items = NewsItem::latest()->get(); // Ambil berita terbaru

    return view('user.index', compact('data', 'news_setting', 'news_items'));
}

// Tambahkan use Carbon untuk tanggal


// ... 

// 1. Tambahkan Method Baru untuk membuka halaman
public function bookingPage()
{
    return view('user.booking'); // Kita akan buat file ini di langkah 3
}

// 2. Update Method storeBooking
public function storeBooking(Request $request)
{
    // ... (Validasi dan Logika Nomor Antrian biarkan sama) ...
    // Copy saja logika antrian dari kode sebelumnya
    
    $request->validate([
        'customer_name' => 'required',
        'vehicle_type' => 'required',
        'phone_number' => 'required',
        'booking_date' => 'required|date',
    ]);

    $countToday = \App\Models\Booking::whereDate('booking_date', $request->booking_date)->count();
    $nextQueue = $countToday + 1;

    \App\Models\Booking::create([
        'user_id' => Auth::id(), // Pakai Auth::id() agar aman
        'service_id' => 1,
        'booking_date' => $request->booking_date,
        'customer_name' => $request->customer_name,
        'vehicle_type' => $request->vehicle_type,
        'phone_number' => $request->phone_number,
        'vehicle_plate' => '-', 
        'problem_note' => $request->problem_note,
        'queue_number' => $nextQueue,
        'status' => 'pending'
    ]);

    // 3. UBAH REDIRECT: Kembali ke halaman booking.index (bukan home lagi)
    return redirect()->route('booking.index')
                     ->with('success_booking', true)
                     ->with('queue_number', $nextQueue)
                     ->with('booking_date', $request->booking_date);
}

// ... method bookingPage & storeBooking sebelumnya ...

// 3. Method untuk Menampilkan Riwayat
public function history()
{
    // Ambil booking milik user yang sedang login, urutkan dari yang terbaru
    $bookings = \App\Models\Booking::where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->orderBy('booking_date', 'desc')
                        ->get();

    return view('user.history', compact('bookings'));
}

}
