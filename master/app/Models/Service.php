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
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function booking(){
        return $this->hasMany(Booking::class,'bookings_id');
       }
       public function feed(){
        return $this->hasMany(Feed::class,'feeds_id');
       }

protected $fillable = ['name', 'description', 'sub_salons_id', 'users_id', 'categories_id'];

}
