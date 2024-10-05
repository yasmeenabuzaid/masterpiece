<?php
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
use App\Http\Controllers\HomeController;

use  App\Http\Middleware\Admin;
Route::get('/', function () {
    return view('index');
});

Auth::routes();
Route::resource('testimonials', TestimonialController::class);
// Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

Route::resource('home', HomeController::class);

Route::get('/dash', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return view('user_side/index');
});

// Route::resource('/home', TestimonialController::class);

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
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('employees', [UserController::class, 'employees'])->name('employees.index');
Route::get('superAdmins', [UserController::class, 'superAdmins'])->name('superAdmins.index');
Route::get('owners', [UserController::class, 'owners'])->name('owners.index');
Route::get('castomors', [UserController::class, 'castomors'])->name('castomors.index');

});

