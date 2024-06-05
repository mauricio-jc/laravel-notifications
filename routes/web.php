<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ExceptionsController;
use App\Events\MyEvent;

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/notification/{title}/{message}', [NotificationsController::class, 'notification'])->name('notification');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Route::get('/exceptions', [ExceptionsController::class, 'index']);
});

// Route::get('/test', function () {
//     event(new MyEvent());
// });