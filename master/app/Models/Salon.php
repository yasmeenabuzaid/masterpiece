<?php

namespace App\Models;                                
use App\Models\owner;    
use App\Models\SubSalon;                                                       
use Illuminate\Database\Eloquent\Factories\HasFactory;
// -------------------------------------------------------
use Illuminate\Database\Eloquent\Model;
//  is the foundation for Eloquent ORM (Object-Relational Mapping), which provides a powerful and expressive way to interact with the database.
// -------------------------------------------------------
class Salon extends Model
{
    use HasFactory;

    public function owners()
    {
        return $this->hasMany(Owner::class,'owners_id');
        
    }
    public function subSalons(){
        return $this->hasMany(SabSalon::class,'SabSalon_id');
       }
}
