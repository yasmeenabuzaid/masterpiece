<?php

namespace App\Models;
use App\Models\SubSalon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'sub_salons_id'];
    public function subsalon()
    {
        return $this->belongsTo(SubSalon::class, 'sub_salon_id');
    }
}
