<?php
// use App\Http\Controllers\WorkingHourController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalonController;
// use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SubSalonController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\CastomorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkingHourController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\ProfileController;

use  App\Http\Middleware\Admin;
Route::post('/change-language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change.language');
Route::get('/logout', function () {
    return view('user_side/landing');
})->name('user_landing');
Route::post('/logout', [Controller::class, 'logout'])->name('logout');
// Route::post('/landing', [HomeController::class, 'logout'])->name('logout');


Route::get('/home', function () {
    return view('user_side/landing');
})->name('home_psge');
Route::get('/', action: function () {
    return view('user_side/landing');
})->name('home_psge');

Route::get('landing', function () {
    return view('user_side/landing');
});
// Route::get('landing' ,HomeController::class)->name('home');
// Route::get('/AllSalons', function () {
//     return view('user_side/all_salons');
// })->name('all_salons');
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

Auth::routes();

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


// Route::middleware(['salon'])->group(function () {
//     Route::post('/send-message', [ChatMessageController::class, 'sendMessage'])->name('send.message');
//     Route::get('/messages/owner/{salon_id}', [ChatMessageController::class, 'indexForOwner'])->name('messages.index.owner');
//     Route::get('/messages/user/{salon_id}', [ChatMessageController::class, 'indexForUser'])->name('messages.index.user');
// });
Route::post('/send-message', [ChatMessageController::class, 'sendMessage'])->name('send.message');
Route::get('/messages/owner/{salon_id}', [ChatMessageController::class, 'indexForOwner'])->name('messages.index.owner');
Route::get('/messages/user/{salon_id}', [ChatMessageController::class, 'indexForUser'])->name('messages.index.user');


Route::middleware(['auth'])->group(function () {
    Route::post('testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
});

Route::resource('testimonials', TestimonialController::class);
// Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
Route::get('/category/{id}', [CategorieController::class, 'show'])->name('all-categories');
Route::get('/service/{categorie}', [ServiceController::class, 'show'])->name('all-services');

Route::get('home', [SubSalonController::class, 'showAllSubSalons'])->name('all_subsalons');
Route::get('/', [SubSalonController::class, 'showAllSubSalons'])->name('all_subsalons');
Route::get('more_subsalons', [SubSalonController::class, 'MoreAllSubSalons'])->name('more_subsalons');
Route::get('salon/{subsalon}', [SubSalonController::class, 'show'])->name('single_salon');

Route::get('/dash', function () {
    return view('dashboard\index');
})->name('dashbourd');
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login.index');


Route::get('/user', function () {
    return view('user_side/index');
});
Route::get('/user-booking', function () {
    return view('user_side/booking');
})->name('user-booking');

// Route::resource('/home', TestimonialController::class)->name('home_psge');

Route::middleware(['auth', 'admin'])->group(function () {

Route::get('/dashboard',  [DashboardController::class, 'index'])->name('count');
Route::resource('salons', SalonController::class);
Route::resource('subsalons', SubSalonController::class);
// Route::resource('owners', OwnerController::class);

Route::resource('users', UserController::class);
Route::resource('services', ServiceController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('categories', CategorieController::class);
Route::resource('bookings', BookingController::class);
Route::resource('feedbacks', FeedController::class);
Route::resource('castomors', CastomorController::class);
Route::resource('profile', ProfileController::class);
Route::resource('castomors',  CastomorController::class);
Route::resource('working_hours', WorkingHourController::class);
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('employees', [UserController::class, 'employees'])->name('employees.index');
Route::get('superAdmins', [UserController::class, 'superAdmins'])->name('superAdmins.index');
Route::get('owners', [UserController::class, 'owners'])->name('owners.index');
Route::get('castomors', [UserController::class, 'castomors'])->name('castomors.index');
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profiles/{user}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');
Route::get('/dashboard/home', [UserController::class, 'showUsers'])->name('dashboard.home');

});

