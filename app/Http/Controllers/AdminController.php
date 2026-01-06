<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Statistik Ringkas
        $total_pending = Booking::where('status', 'pending')->count();
        $total_today = Booking::whereDate('booking_date', today())->count();
        // Hitung estimasi pendapatan dari booking yang 'completed'
        $income = Booking::where('status', 'completed')
                    ->join('services', 'bookings.service_id', '=', 'services.id')
                    ->sum('services.price');

        // 2. Ambil Data Booking (Urutkan dari yang terbaru)
        // Kita pakai 'with' agar query lebih cepat (Eager Loading)
        $bookings = Booking::with(['user', 'service'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); // Pakai pagination biar rapi jika data banyak

        return view('admin.dashboard', compact('bookings', 'total_pending', 'total_today', 'income'));
    }

    // Tambahkan fungsi untuk update status
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui!');
    }
}