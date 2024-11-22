<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\SubSalonController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImageController;

Auth::routes();
Route::get('/logout', function () {
    return view('user_side/landing');
})->name('user_landing');
Route::get('/about', function () {
    return view('user_side/about');
})->name('about');
Route::post('/logout', [Controller::class, 'logout'])->name('logout');

Route::get('/home', action: [HomeController::class, 'index']);


Route::get('/home', function () {
    return view('user_side/landing');
})->name('home_psge');
Route::get('/', action: function () {
    return view('user_side/landing');
})->name('home_psge');

Route::get('landing', function () {
    return view('user_side/landing');
});

Route::get('/more-deteils', function () {
    return view('user_side\more_details');
})->name('more_deteils');
Route::get('/more-images', function () {
    return view('user_side\more_images');
})->name('more_images');
Route::get('/salon-categories', function () {
    return view('user_side\categories');
})->name('categories_user_side');
Route::get('/salon-services', function () {
    return view('user_side/services');
})->name('services_user_side');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');



Route::get('subsalons/{subSalonId}/categories-services', [SubSalonController::class, 'showCategoriesAndServices'])->name('subsalons.categories-services');
Route::get('/service/{categorie}', [ServiceController::class, 'show'])->name('all-services');

Route::get('home', [SubSalonController::class, 'showAllSubSalons'])->name('all_subsalons');
Route::get('/', [SubSalonController::class, 'showAllSubSalons'])->name('all_subsalons');
Route::get('more_subsalons', [SubSalonController::class, 'MoreAllSubSalons'])->name('more_subsalons');
Route::get('/salons/{salonId}/categories', [CategorieController::class, 'showCategoriesBySalon'])->name('salon.categories');

Route::get('salon/{subsalon}', [SubSalonController::class, 'show'])->name('single_salon');

Route::get('/subsalons/{subsalonId}/categories', action: [CategorieController::class, 'showCategoriesBySalon'])->name('subsalon.categories');

// Route::get('/dash', function () {
//     return view('dashboard\index');
// })->name('dashbourd');
Route::get('/subscribe', function () {
    return view('user_side.subscribe');
})->name('subscribe');
Route::get('/more-service', function () {
    return view('user_side.service');
})->name('service');

Route::get('/user', function () {
    return view('user_side/index');
});
Route::get('/user-booking', function () {
    return view('user_side/booking');
})->name('user-booking');
Route::get('/home', [SubSalonController::class, 'showAllSubSalons'])->name('home');

Route::get('/select-services', [BookingController::class, 'showServices'])->name('services.index')->middleware('auth');
Route::resource('/contacts', ContactController::class);

Route::get('/services', [BookingController::class, 'showServices'])->name('services.index');
Route::get('/booking/{subSalonId}', [BookingController::class, 'showBookingForm'])->name('booking.form');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/my-booking', [BookingController::class, 'get'])->name('my_booking');
Route::get('/subsalon/{subSalonId}/available-times', [BookingController::class, 'showAvailableTimes']);
Route::get('/user_side/booking', [BookingController::class, 'showBookingForm'])->name('user_side.booking');

Route::resource('feeds', FeedController::class);

Route::get('/profile', [UserController::class, 'showProfile'])->name('users.profile');
Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('users.editProfile');

Route::put('/profile', [UserController::class, 'updateProfile'])->name('users.updateProfile');

Route::get('/salon/{salonId}/subsalon/{subSalonId}/categories', [CategorieController::class, 'showCategoriesBySalon'])->name('showCategoriesBySalon');
Route::put('/update-profile-user', [UserController::class, 'updateProfileUser'])->name('update_profile_user');

Route::resource('bookings', BookingController::class);

Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/dashboard',  [DashboardController::class, 'index'])->name('count');
Route::resource('salons', SalonController::class);
Route::post('salons/{id}/restore', [SalonController::class, 'restore'])->name('salons.restore');
Route::delete('salons/{id}/force-delete', [SalonController::class, 'forceDelete'])->name('salons.forceDelete');
Route::get('salons/trashed', [SalonController::class, 'trashed'])->name('salons.trashed');
Route::resource('subsalons', SubSalonController::class);
Route::get('/show-subsalon/{id}', [SubSalonController::class, 'viewSubSalon'])->name('subsalons.view');
Route::get('/showsalon/{id}', [SalonController::class, 'view_Salon'])->name('salons.view');
Route::delete('/images/{id}',   [ImageController::class, 'destroy'])->name('images.destroy');
Route::delete('bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
Route::resource('users', UserController::class);
Route::resource('services', ServiceController::class);
Route::resource('categories', CategorieController::class);
Route::resource('feedbacks', FeedController::class);
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('employees', [UserController::class, 'employees'])->name('employees.index');
Route::get('superAdmins', [UserController::class, 'superAdmins'])->name('superAdmins.index');
Route::get('owners', [UserController::class, 'owners'])->name('owners.index');
Route::get('castomors', [UserController::class, 'castomors'])->name('castomors.index');
Route::get('/dashboard/home', [UserController::class, 'showUsers'])->name('dashboard.home');

});

