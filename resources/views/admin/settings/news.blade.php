@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 fw-bold">Pengaturan Berita & Promo</h2>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white fw-bold">1. Judul & Deskripsi Seksi</div>
        <div class="card-body">
            <form action="{{ route('admin.news.updateSetting') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Judul Besar</label>
                        <input type="text" name="title" class="form-control" value="{{ $setting->title }}">
                    </div>
                    <div class="col-md-7 mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="description" class="form-control" value="{{ $setting->description }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Update Judul</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
            <span>2. Daftar Kartu Berita</span>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                <i class="bi bi-plus-circle"></i> Tambah Berita Baru
            </button>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>Gambar</th>
                        <th>Badge</th>
                        <th>Judul & Isi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news_items as $item)
                    <tr>
                        <td>
                            @if(str_contains($item->image_path, 'http'))
                                <img src="{{ $item->image_path }}" width="60" class="rounded">
                            @else
                                <img src="{{ asset('storage/' . $item->image_path) }}" width="60" class="rounded">
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $item->badge_color }}">{{ $item->badge_text }}</span>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $item->title }}</div>
                            <small class="text-muted">{{ Str::limit($item->content, 50) }}</small>
                        </td>
                        <td>
                            <form action="{{ route('admin.news.destroyItem', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Berita/Promo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.news.storeItem') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul Berita</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label>Teks Badge</label>
                            <input type="text" name="badge_text" class="form-control" placeholder="Misal: Promo" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label>Warna Badge</label>
                            <select name="badge_color" class="form-select">
                                <option value="primary">Biru (Primary)</option>
                                <option value="success">Hijau (Success)</option>
                                <option value="danger">Merah (Danger)</option>
                                <option value="warning">Kuning (Warning)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Isi Berita</label>
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection