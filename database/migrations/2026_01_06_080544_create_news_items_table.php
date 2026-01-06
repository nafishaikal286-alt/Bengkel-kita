<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_items', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');      // Foto Berita
            $table->string('badge_text');      // Teks Badge (misal: Promo)
            $table->string('badge_color')->default('primary'); // Warna Badge (primary, success, danger)
            $table->string('title');           // Judul Berita
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_items');
    }
};
