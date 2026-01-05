<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ini akan memanggil file resources/views/user/index.blade.php
        // Pastikan file view tersebut sudah Anda buat sesuai desain Anda
        return view('user.index'); 
    }
}
