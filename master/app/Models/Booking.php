<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    //    public function service()
    //    {

    //        return $this->belongsTo(Service::class, 'services_id');

    //    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookingServices()
    {
        return $this->hasMany(BookingService::class);
    }
            protected $fillable = [
        'name',
        'email',
        'note',
        'date',
        'time',
        'user_id'
    ];
}
