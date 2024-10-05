<?php

namespace App\Models;
use App\Models\users;
use App\Models\SubSalon;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// -------------------------------------------------------
use Illuminate\Database\Eloquent\Model;
//  is the foundation for Eloquent ORM (Object-Relational Mapping), which provides a powerful and expressive way to interact with the database.
// -------------------------------------------------------
class Salon extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class); //->owners
    }
    public function subsalon(){ //many
        return $this->hasMany(SubSalon::class,'sub_salons_id');
       }


}
