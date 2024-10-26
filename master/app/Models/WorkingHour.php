<?php

namespace App\Models;
use App\Models\EmployeeBreak;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    use HasFactory;
    protected $fillable = ['sub_salons_id', 'day', 'open_time', 'close_time'];

    public function employee_break()
{
    return $this->hasMany(EmployeeBreak::class, 'working_hours_id');
}

       public function subsalon()
       {
           return $this->belongsTo(SubSalon::class, 'sub_salons_id');
       }
}
