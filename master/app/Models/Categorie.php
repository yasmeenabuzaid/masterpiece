<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sub_salons_id',
        'user_id',
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'categories_id');
    }


    public function cat_det()
    {
        return $this->hasMany(Category_Details::class, 'cat_det_id');
    }

    public function subSalon()
    {
        return $this->belongsTo(SubSalon::class, 'sub_salons_id');
    }



}
