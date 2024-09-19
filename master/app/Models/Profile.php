<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;
   public function user(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id');
}
}
