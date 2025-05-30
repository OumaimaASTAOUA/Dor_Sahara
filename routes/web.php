<?php

use App\Http\Controllers\Admin\ApartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\GroupTouristiqueController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\PublicDestinationController;
use App\Http\Controllers\PublicHotelController;
use App\Http\Controllers\PublicRestaurantController;

// Routes publiques
Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');

// Routes d'authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', action: [LoginController::class, 'logout'])->name('logout');

// Routes de réinitialisation de mot de passe
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Routes des services publics
Route::get('/destinations', [PublicDestinationController::class, 'index'])->name('destination.index');
Route::get('/hotels', [PublicHotelController::class, 'index'])->name('hotels.index');
Route::get('/restaurants', [PublicRestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{category}', [PublicRestaurantController::class, 'showRestaurantsByCategory'])->name('restaurants.byCategory');

// Routes d'administration
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Gestion des utilisateurs
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store');
    Route::post('/hotels/{id}', [HotelController::class, 'update'])->name('hotels.update');
    Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');
    Route::put('/hotels/{id}', [HotelController::class, 'update'])->name('hotels.update');
    Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');

    Route::post('/apartments', [ApartmentController::class, 'store'])->name('apartments.store');
    Route::post('/apartments/{id}', [ApartmentController::class, 'update'])->name('apartments.update');
    Route::delete('/apartments/{id}', [ApartmentController::class, 'destroy'])->name('apartments.destroy');
    Route::put('/apartments/{id}', [ApartmentController::class, 'update'])->name('apartments.update');
    Route::delete('/apartments/{id}', [ApartmentController::class, 'destroy'])->name('apartments.destroy');

    // Routes des destinations
    Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
    Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
    Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');
    Route::put('/destinations/{id}', [DestinationController::class, 'update'])->name('destinations.update');
    Route::delete('/destinations/{id}', [DestinationController::class, 'destroy'])->name('destinations.destroy');

    // Routes des groupes touristiques
    Route::get('/group_touristiques', [GroupTouristiqueController::class, 'index'])->name('group_touristiques.index');
    Route::post('/group_touristiques', [GroupTouristiqueController::class, 'store'])->name('group_touristiques.store');
    Route::put('/group_touristiques/{id}', [GroupTouristiqueController::class, 'update'])->name('group_touristiques.update');
    Route::delete('/group_touristiques/{id}', [GroupTouristiqueController::class, 'destroy'])->name('group_touristiques.destroy');

    // Routes des restaurants
    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurant.store');
    Route::get('/restaurants/{id}', [RestaurantController::class, 'show'])->name('restaurant.show');
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update'])->name('restaurant.update');
    Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy'])->name('restaurant.destroy');

    // Routes des menus
    Route::post('/menus', [RestaurantController::class, 'storeMenu'])->name('menus.store');
    Route::get('/menus/{id}', [RestaurantController::class, 'showMenu'])->name('menus.show');
    Route::put('/menus/{id}', [RestaurantController::class, 'updateMenu'])->name('menus.update');
    Route::delete('/menus/{id}', [RestaurantController::class, 'destroyMenu'])->name('menus.destroy');


});
