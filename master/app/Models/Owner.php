<?php

namespace App\Models;
use App\Models\Salon;                                                       

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salons_id');
    }
}
