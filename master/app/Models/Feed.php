<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;
    protected $fillable = [
        'feedback',
        'rating',
        'users_id',
        'sub_salons_id',
        // Add any other necessary fields here
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }



public function subsalon()
{
    return $this->belongsTo(SubSalon::class, 'sub_salons_id');
}

public static $rules = [
    'feedback' => 'required|string',
    'rating' => 'required|integer|min:1|max:5',
];
}
