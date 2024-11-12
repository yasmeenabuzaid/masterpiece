<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function subSalon()
    {
        return $this->belongsTo(SubSalon::class, 'sub_salons_id');
    }


    public function user()
{
    return $this->belongsTo(User::class);
}



public function services()
{
    return $this->belongsToMany(Service::class, 'booking_services', 'booking_id', 'service_id');
}

}
