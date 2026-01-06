<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   protected $fillable = [
    'user_id', 
    'service_id', 
    'booking_date', 
    'vehicle_plate', // Tetap kita simpan jika ada
    'problem_note', 
    'status',
    // Kolom Baru:
    'customer_name',
    'vehicle_type',
    'phone_number',
    'queue_number'
];

// Relasi (Penting untuk dashboard admin)
public function user() { return $this->belongsTo(User::class); }
public function service() { return $this->belongsTo(Service::class); }
}
