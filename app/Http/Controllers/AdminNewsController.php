<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsSetting;
use App\Models\NewsItem;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    // 1. Tampilkan Halaman Pengaturan
    public function index()
    {
        $setting = NewsSetting::first();
        $news_items = NewsItem::all();
        return view('admin.settings.news', compact('setting', 'news_items'));
    }

    // 2. Update Judul & Deskripsi Seksi
    public function updateSetting(Request $request)
    {
        $request->validate(['title' => 'required', 'description' => 'required']);
        
        $setting = NewsSetting::first();
        $setting->update($request->only('title', 'description'));
        
        return back()->with('success', 'Judul seksi berhasil diupdate!');
    }

    // 3. Simpan Berita Baru
    public function storeItem(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'badge_text' => 'required',
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('news', 'public');

        NewsItem::create([
            'image_path' => $path,
            'title' => $request->title,
            'content' => $request->content,
            'badge_text' => $request->badge_text,
            'badge_color' => $request->badge_color ?? 'primary',
        ]);

        return back()->with('success', 'Berita berhasil ditambahkan!');
    }

    // 4. Hapus Berita
    public function destroyItem($id)
    {
        $item = NewsItem::findOrFail($id);
        
        // Hapus file gambar jika ada di storage
        if (!str_contains($item->image_path, 'http')) {
            Storage::delete('public/' . $item->image_path);
        }
        
        $item->delete();
        return back()->with('success', 'Berita berhasil dihapus!');
    }
}
