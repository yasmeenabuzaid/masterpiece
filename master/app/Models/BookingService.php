<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/BookingService.php
class BookingService extends Model
{
    protected $fillable = ['booking_id', 'service_id'];

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function booking() {
        return $this->belongsTo(Booking::class);
    }
}
