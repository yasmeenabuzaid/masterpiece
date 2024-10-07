<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubSalon;
class Service extends Model
{
    use HasFactory;
    public function subsalon()
    {
        return $this->belongsTo(SubSalon::class, 'sub_salons_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categories_id');
    }

    public function booking(){
        return $this->hasMany(Booking::class,'bookings_id');
       }
       public function ser_det()
       {
           return $this->hasMany(Service_Details::class, 'ser_det_id');
       }
       public function feed(){
        return $this->hasMany(Feed::class,'feeds_id');
       }

protected $fillable = ['name', 'description', 'sub_salons_id','price', 'users_id','duration', 'categories_id'];

}
