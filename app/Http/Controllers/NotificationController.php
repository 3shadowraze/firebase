<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\DriverCalled;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifyToDriver(User $driver){
        $user = auth()->user();
        $driver->notify(new DriverCalled($user));
    }
}
