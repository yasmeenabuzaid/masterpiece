<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    // public function booking(){
    //     return $this->hasMany(Booking::class,'bookings_id');
    //    }
    //    public function subsalon()
    //    {
    //        return $this->belongsTo(SubSalon::class, 'sub_salons_id');
    //    }
    //    protected $fillable = [
    //     'first_name', 'last_name', 'email', 'password', 'sub_salons_id',
    // ];
    //   }

}
