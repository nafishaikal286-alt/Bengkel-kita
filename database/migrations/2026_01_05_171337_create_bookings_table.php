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
        Schema::create('bookings', function (Blueprint $table) {
           $table->id();
            $table->foreignId('user_id')->constrained(); // Pelanggan
            $table->foreignId('service_id')->constrained(); // Jenis Service
            $table->date('booking_date');
            $table->string('vehicle_plate'); // Plat Nomor
            $table->text('problem_note')->nullable(); // Keluhan
            $table->enum('status', ['pending', 'confirmed', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
