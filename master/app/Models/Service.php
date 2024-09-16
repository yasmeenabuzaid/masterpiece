<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubSalon;
use App\Models\Subcat;
class Service extends Model
{
    use HasFactory;
    public function subsalon()
    {
        return $this->belongsTo(SubSalon::class, 'sub_salons_id');
    }
    public function subcat()
    {
        return $this->belongsTo(Subcat::class, 'subcats_id');
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categories_id');
    }
    public function booking(){
        return $this->hasMany(Booking::class,'bookings_id');
       }
       public function feed(){
        return $this->hasMany(Feed::class,'feeds_id');
       }
     // In Service.php model
protected $fillable = ['name', 'description', 'sub_salons_id', 'subcats_id', 'categories_id'];

}
