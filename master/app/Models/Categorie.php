<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    public function service(){
        return $this->hasMany(Service::class,'services_id');
       }


    public function salon()
    {
        return $this->belongsTo(Salon::class,'salons_id');
    }


}
