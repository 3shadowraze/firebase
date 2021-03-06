<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::patch('/fcm-token', [DashboardController::class, 'updateToken'])->name('fcmToken');
Route::get('/taxi/call/{driver}', [DashboardController::class, 'notifyToDriver'])->middleware(['passenger']);
Route::get('/taxi/arrived/{passenger}', [DashboardController::class, 'notifyToPassenger'])->middleware(['driver']);

require __DIR__.'/auth.php';
