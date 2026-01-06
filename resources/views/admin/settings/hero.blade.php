@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">
                    <i class="bi bi-brush"></i> Pengaturan Tampilan Utama (Hero Section)
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Slogan</label>
                            <input type="text" name="slogan_title" class="form-control" value="{{ $setting->slogan_title }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kalimat Pendukung</label>
                            <textarea name="slogan_text" class="form-control" rows="3">{{ $setting->slogan_text }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Background Saat Ini:</label><br>
                            @if(str_contains($setting->hero_image, 'http'))
                                <img src="{{ $setting->hero_image }}" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                            @else
                                <img src="{{ asset('storage/' . $setting->hero_image) }}" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ganti Background (Opsional)</label>
                            <input type="file" name="hero_image" class="form-control">
                            <small class="text-muted">Format: JPG, PNG. Max: 2MB.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection