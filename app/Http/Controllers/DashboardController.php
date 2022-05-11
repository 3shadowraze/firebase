<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index (){
        $user = Auth::user();
        if ($user->type == 'passenger'){
            $drivers = User::where('type','driver')->get();
            return view('dashboard',[
                'drivers' => $drivers
            ]);
        }

        return view('dashboard');
    }
}
