<?php

namespace App\Models;
use App\Models\users;
use App\Models\SubSalon;
use App\Models\Categorie;
use App\Models\Massage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// -------------------------------------------------------
use Illuminate\Database\Eloquent\Model;
//  is the foundation for Eloquent ORM (Object-Relational Mapping), which provides a powerful and expressive way to interact with the database.
// -------------------------------------------------------
class Salon extends Model
{
    use HasFactory;
        use SoftDeletes;

        protected $fillable = ['name', 'description', 'image'];

        protected $dates = ['deleted_at'];



public function users()
{
    return $this->hasMany(User::class, 'salons_id');
}



public function subsalon()

{
    return $this->hasMany(SubSalon::class, 'salon_id');
}



}
