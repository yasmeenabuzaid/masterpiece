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

       }
       public function employee()
       {

           return $this->belongsTo(Employee::class, 'employees_id');

       }
       public function castomor()
       {

           return $this->belongsTo(Castomor::class, 'castomors_id');

       }
       protected $fillable = ['name', 'description', 'castomors_id', 'employees_id', 'services_id','appointment_date'];

}
