<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;
    public function service()
    {
        return $this->belongsTo(Service::class, 'services_id');
    }
    public function castomor()
    {
        return $this->belongsTo(Castomor::class, 'castomors_id');
    }
}
