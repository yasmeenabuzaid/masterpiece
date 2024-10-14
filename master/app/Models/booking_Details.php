<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking_Details extends Model
{
    use HasFactory;
    public function service()
    {
        return $this->belongsTo(Service::class, 'services_id');
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookings_id');
    }
}
