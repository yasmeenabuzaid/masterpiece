<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

       public function service()
       {

           return $this->belongsTo(Service::class, 'services_id');
           return $this->belongsTo(Employee::class, 'employees_id');
           return $this->belongsTo(Castomor::class, 'castomors_id');

       }
}
