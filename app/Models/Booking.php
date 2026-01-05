<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
    'user_id', 'service_id', 'booking_date', 'vehicle_plate', 'problem_note', 'status'
];

// Relasi (Penting untuk dashboard admin)
public function user() { return $this->belongsTo(User::class); }
public function service() { return $this->belongsTo(Service::class); }
}
