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

Route::get('/push-notificaiton', [NotificationController::class, 'home'])->name('push-notificaiton');
Route::post('/store-token', [NotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [NotificationController::class, 'sendWebNotification'])->name('send.web-notification');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/taxi/call/{driver}', [NotificationController::class, 'notifyToDriver'])->middleware(['passenger']);

require __DIR__.'/auth.php';
