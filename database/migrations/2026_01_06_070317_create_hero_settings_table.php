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
    Schema::create('hero_settings', function (Blueprint $table) {
        $table->id();
        $table->string('hero_image')->nullable(); // Path gambar
        $table->string('slogan_title');           // Judul Besar
        $table->text('slogan_text');              // Teks Kecil
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_settings');
    }
};
