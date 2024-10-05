<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    // إضافة الخصائص القابلة للتعيين الجماعي
    protected $fillable = [
        'name',         // أضف هذا
        'description',
        'sub_salons_id',
        'user_id',
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'services_id');
    }

    public function subsalon()
    {
        return $this->belongsTo(SubSalon::class, 'sub_salons_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
