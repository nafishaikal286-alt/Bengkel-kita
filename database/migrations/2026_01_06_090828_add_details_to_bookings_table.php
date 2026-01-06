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
        Schema::table('bookings', function (Blueprint $table) {
             $table->string('customer_name')->after('user_id')->nullable(); // Nama Pelanggan (input manual)
                $table->string('vehicle_type')->after('customer_name')->nullable(); // Jenis Motor
                $table->string('phone_number')->after('vehicle_type')->nullable(); // No HP
                $table->integer('queue_number')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
