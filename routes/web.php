<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [CustomAuthController::class, 'dashboard']);
Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::group(['middleware' => 'auth'], function () {
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::get('locations', [HomeController::class, 'locations'])->name('locations');
    Route::post('add-location', [HomeController::class, 'addLocation'])->name('add.location');
    Route::get('ticket', [HomeController::class, 'show'])->name('show.ticket');
    Route::post('ticket/send', [HomeController::class, 'send'])->name('send.ticket');
    Route::get('tickets', [HomeController::class, 'list'])->name('list.tickets');
    Route::get('/talep-detaylari/{id}', [HomeController::class, 'details']);
    Route::get('/shoping', [HomeController::class, 'products'])->name('all.products');
    Route::post('/buy', [HomeController::class, 'buyCripto']);
    Route::get('/all-orders', [HomeController::class, 'myOrders'])->name('all.orders');
});