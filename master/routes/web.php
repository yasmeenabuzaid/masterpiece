<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SubSalonController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SubcatController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\CastomorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use  App\Http\Middleware\Admin;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dash', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return view('user_side/index');
});
Route::middleware(['auth', 'admin'])->group(function () {

Route::get('/dashboard',  [DashboardController::class, 'index'])->name('count');
Route::resource('salons', SalonController::class);
Route::resource('subsalons', SubSalonController::class);
Route::resource('owners', OwnerController::class);
Route::resource('services', ServiceController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('categories', CategorieController::class);
// Route::resource('subcategories', SubcatController::class);
Route::resource('bookings', BookingController::class);
Route::resource('feedbacks', FeedController::class);
Route::resource('castomors', CastomorController::class);
Route::resource('profile', ProfileController::class);
Route::resource('castomors',  CastomorController::class);
Route::resource('subcategories', SubcatController::class);

});

