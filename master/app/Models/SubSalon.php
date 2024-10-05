<?php

namespace App\Models;
use App\Models\Salon;
use App\Models\Image;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSalon extends Model
{
    use HasFactory;
    public function salon()
    {
        return $this->belongsTo(Salon::class,'salons_id'); //1salon
    }
    public function Image(){
        return $this->hasMany(Image::class,'Images_id');
       }
       public function service(){
        return $this->hasMany(Service::class,'services_id');
       }
       public function users(){
        return $this->hasMany(User::class,'users_id');
       }
       public function testimonial(){
        return $this->hasMany(Testimonial::class,'testimonial_id');
       }
       public function categorie(){
        return $this->hasMany(Categorie::class,'salons_id');
       }

}
