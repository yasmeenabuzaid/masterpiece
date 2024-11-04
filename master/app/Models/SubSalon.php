<?php
namespace App\Models;

use App\Models\Salon;
use App\Models\Image;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\User;
use App\Models\Booking;
use App\Models\WorkingHour;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSalon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'description',
        'phone',
        'image',
        'salon_id',
        'working_days',
        'opening_hours_start',
        'opening_hours_end',
        'location',
        'map_iframe',
        'type'
    ];


    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'sub_salons_id');
    }


    public function services()
    {
        return $this->hasMany(Service::class, 'services_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'sub_salons_id');
    }

    public function usersCount()
    {
        return $this->users()->count();
    }
    // public function bookings()
    // {
    //     return $this->hasMany(Booking::class, 'bookings_id');
    // }

    public function categories()
    {
        return $this->hasMany(Categorie::class, 'sub_salons_id');
    }

    public function workingHours()
    {
        return $this->hasMany(WorkingHour::class, 'sub_salons_id');
    }

    public function getWorkingDaysAttribute($value)
    {
        return json_decode($value, true);
    }

    // إضافة دوال لتحويل ساعات العمل
    public function getOpeningHoursStartAttribute($value)
    {
        return $value; // يمكن تنسيق القيمة حسب الحاجة
    }

    public function getOpeningHoursEndAttribute($value)
    {
        return $value; // يمكن تنسيق القيمة حسب الحاجة
    }

    // دالة لتصفية الصالونات النشطة
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // دالة لتحديد ما إذا كان الصالون مفتوحًا
    public function isOpen()
    {
        return $this->status == 1;
    }
    // In SubSalon.php
public function bookings()
{
    return $this->hasManyThrough(Booking::class, Service::class);
}
public function feeds()
{
    return $this->hasMany(Feed::class, 'sub_salons_id'); // تأكد من أن 'sub_salons_id' هو اسم العمود في جدول feeds
}
public function averageRating()
{
    return $this->feeds()->average('rating'); 
}

}
