<?php

namespace App\Models;
use App\Models\Salon;                                                                                         
use App\Models\Image;  
use App\Models\Service; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSalon extends Model
{
    use HasFactory;
    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salons_id');
    }
    public function Image(){
        return $this->hasMany(Image::class,'Images_id');
       }
       public function service(){
        return $this->hasMany(Service::class,'service_id');
       }
}
