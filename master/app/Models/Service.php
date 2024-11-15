<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubSalon;
use App\Models\Categorie;
use App\Models\Booking;
use App\Models\Service_Details;
use App\Models\Feed;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'sub_salons_id', 'price', 'users_id', 'duration', 'categories_id'];

    public function subsalon()
    {
        return $this->belongsTo(SubSalon::class, 'sub_salons_id');
    }

public function categorie()
{
    return $this->belongsTo(Categorie::class, 'categories_id');
}


    public function bookingServices()
    {
        return $this->hasMany(BookingService::class);
    }
    public function ser_det()
    {
        return $this->hasMany(Service_Details::class, 'ser_det_id');
    }

    public function feed()
    {
        return $this->hasMany(Feed::class, 'feeds_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_services', 'service_id', 'booking_id');
    }
}
