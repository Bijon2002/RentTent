<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\BookingController;

// ---------------- Home ----------------
Route::get('/', fn() => view('welcome'))->name('home');

// ---------------- Auth ----------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/signup', [SignupController::class, 'showForm'])->name('register');
Route::post('/signup', [SignupController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ---------------- Profile ----------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// ---------------- Static Pages ----------------
Route::view('/properties', 'pages.properties')->name('properties');
Route::view('/about', 'pages.aboutup')->name('aboutup');

// ---------------- Food Marketplace ----------------
// Public marketplace view
Route::get('/foodplans', [FoodController::class, 'marketplace'])->name('foodplans.index');

// ---------------- Vendor Food Management ----------------
Route::middleware('auth')->prefix('vendor')->group(function () {
    // CRUD for vendor foods
    Route::get('/foods', [FoodController::class, 'index'])->name('vendor.foods');
    Route::get('/foods/create', [FoodController::class, 'create'])->name('vendor.foods.create');
    Route::post('/foods', [FoodController::class, 'store'])->name('vendor.foods.store');
    Route::get('/foods/{id}/edit', [FoodController::class, 'edit'])->name('vendor.foods.edit');
    Route::put('/foods/{id}', [FoodController::class, 'update'])->name('vendor.foods.update');
    Route::delete('/foods/{id}', [FoodController::class, 'destroy'])->name('vendor.foods.destroy');
});

// ---------------- Vendor Details (Public) ----------------
Route::get('/vendor/{id}', [FoodController::class, 'show'])->name('vendor.details');

Route::get('/food-vendors', [FoodController::class, 'index'])->name('food.vendors');

use App\Http\Controllers\SubscriptionController;

Route::post('/vendor/{menu}/subscribe', [SubscriptionController::class, 'subscribe'])
    ->name('subscribe.vendor')
    ->middleware('auth');


use App\Http\Controllers\SuggestionController;

Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions');

use App\Http\Controllers\BoardingController;


Route::middleware(['auth'])->group(function () {
  Route::get('/provider/boardings', [BoardingController::class, 'index'])->name('provider.boardings.index');
    Route::post('/provider/boardings', [BoardingController::class, 'store'])->name('provider.boardings.store');
    Route::delete('/provider/boardings/{id}', [BoardingController::class, 'destroy'])->name('provider.boardings.destroy');
    Route::get('/provider/boardings/{id}/edit', [BoardingController::class, 'edit'])->name('provider.boardings.edit');
    Route::put('/provider/boardings/{id}', [BoardingController::class, 'update'])->name('provider.boardings.update');
    Route::delete('provider/boardings/photo/{id}', [BoardingController::class, 'deletePhoto'])->name('provider.boardings.photo.delete');
});
Route::get('/properties', [BoardingController::class, 'approvedBoardings'])->name('properties');


Route::get('/boarding/{id}', [BoardingController::class, 'show'])
    ->name('boarding.details');

    Route::middleware('auth')->group(function() {
    Route::post('/boarding/{id}/reserve', [BookingController::class, 'reserve'])
         ->name('booking.reserve');
});

Route::get('/boarding/{boarding}/book-now', [BookingController::class, 'bookNow'])
    ->name('booking.booknow');

    
Route::get('/boardings/search', [BoardingController::class, 'search'])->name('boarding.search');
Route::get('/boardings', [BoardingController::class, 'index'])->name('boarding.index');


Route::middleware(['auth'])->group(function() {
    Route::post('/booking/reserve/{boarding}', [BookingController::class, 'reserve'])->name('booking.reserve');
    Route::post('/booking/book/{boarding}', [BookingController::class, 'book'])->name('booking.book');
});

use App\Http\Controllers\API\UserController;

// Show all boarding bookings for logged-in user
Route::get('/user/boardings', [UserController::class, 'myBoardings'])->name('user.boardings');

// Show all subscribed food packages
Route::get('/user/subscriptions', [UserController::class, 'mySubscriptions'])->name('user.subscriptions');


use App\Http\Controllers\FinderController;
// Finder dashboard links
Route::get('/finder/booked-boardings', [FinderController::class, 'bookedBoardings'])->name('finder.booked.boardings');
Route::get('/finder/subscribed-foods', [FinderController::class, 'subscribedFoods'])->name('finder.subscribed.foods');

// This is the CORRECT route
Route::delete('/subscription/{id}/cancel', [FinderController::class, 'cancelSubscription'])->name('subscription.cancel');


//controller  for suggestions 
//use controller
