<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

       public function service()
       {

           return $this->belongsTo(Service::class, 'services_id');

       }
       public function user()
       {

           return $this->belongsTo(User::class, 'user_id');

       }

       protected $fillable = ['name', 'description', 'user_id', 'services_id', 'appointment_date'];

}
