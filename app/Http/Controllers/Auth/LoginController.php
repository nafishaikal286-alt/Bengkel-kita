<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // <--- PENTING: Baris ini WAJIB ada

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // Hapus baris: protected $redirectTo = '/home'; agar tidak bentrok

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // --- Tambahkan Method Ini ---
    public function redirectTo()
    {
        // Pastikan menggunakan Auth::user() dengan huruf 'A' besar
        // Dan pastikan 'role' sesuai dengan nama kolom di database Anda
        $role = Auth::user()->role; 
        
        if ($role == 'admin') {
            return '/admin/dashboard';
        }
        
        return '/home';
    }
}