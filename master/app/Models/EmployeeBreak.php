<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBreak extends Model
{
    public function working_hour()
    {
        return $this->belongsTo(WorkingHour::class, 'working_hours_id');
    }

}
