<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name', 'email', 'password', 'usertype', 'salons_id', 'sub_salons_id', 'image'
    ];

    public function feedback(){
        return $this->hasMany(Feed::class,'feedback_id');
       }
       public function bookings()
       {
           return $this->hasMany(Booking::class);
       }
       public function owner_cat()
       {
           return $this->hasMany(Category_Details::class, 'cat_det_id');
       }
       public function ser_det()
       {
           return $this->hasMany(Service_Details::class, 'ser_det_id');
       }

       public function feeds()
       {
           return $this->hasMany(Feed::class);
       }
       public function salon()
       {
           return $this->belongsTo(Salon::class, 'salons_id');
       }

       public function subSalon()
       {
           return $this->belongsTo(SubSalon::class, 'sub_salons_id');
       }




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

// 1
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // In your User model
public function isSuperAdmin()
{
    return $this->usertype === 'super_admin';
}
public function isOwner()
{
    return $this->usertype === 'owner';
}
public function isEmployee()
{
    return $this->usertype === 'employee';
}

}

