<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function subalon() {
        return $this->belongsTo(SubSalon::class);
    }

    public function customer() {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function bookingServices()
    {
        return $this->hasMany(BookingService::class);
    }


}
