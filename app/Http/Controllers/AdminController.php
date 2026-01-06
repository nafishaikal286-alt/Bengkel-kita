<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSetting;
use Illuminate\Support\Facades\Storage;

class AdminHeroController extends Controller
{
    public function index()
    {
        // Ambil data pertama (karena cuma ada 1 settingan)
        $setting = HeroSetting::first();
        return view('admin.settings.hero', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'slogan_title' => 'required',
            'slogan_text' => 'required',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Validasi Gambar
        ]);

        $setting = HeroSetting::first();

        // Simpan Teks
        $setting->slogan_title = $request->slogan_title;
        $setting->slogan_text = $request->slogan_text;

        // Logika Upload Gambar
        if ($request->hasFile('hero_image')) {
            // Hapus gambar lama jika bukan link dari internet (bukan http)
            if ($setting->hero_image && !str_contains($setting->hero_image, 'http')) {
                Storage::delete('public/' . $setting->hero_image);
            }

            // Simpan gambar baru ke folder storage/app/public/hero
            $path = $request->file('hero_image')->store('hero', 'public');
            $setting->hero_image = $path;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Tampilan Website Berhasil Diupdate!');
    }
}