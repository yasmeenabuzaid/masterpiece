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
       public function booking_det(){
        return $this->hasMany(booking_Details::class,'booking_det_id');
       }
       public function user()
       {

           return $this->belongsTo(User::class, 'user_id');

       }
       public function subsalon()
       {
           return $this->belongsTo(SubSalon::class, 'sub_salons_id');
       }
       protected $fillable = ['name', 'description', 'user_id', 'appointment_date','sub_salons_id'];

}
