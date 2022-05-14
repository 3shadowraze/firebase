<?php

namespace App\Http\Controllers;

use App\Models\TaxiCall;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Notification;
use App\Notifications\SendPushNotification;
use App\Notifications\TaxiArrivedNotification;
use Exception;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index (){

        $user = Auth::user();
        if ($user->type == 'passenger'){
            $drivers = User::where('type','driver')->get();
            return view('dashboard',[
                'drivers' => $drivers
            ]);
        }

        $passenger_ids = $user->taxiCalls()->pluck('passenger_id');
        $passengers = $user->getPassengers($passenger_ids);
        
        return view('dashboard',[
            'passengers' => $passengers
        ]);
    }

    public function updateToken(Request $request){
        try{
            $request->user()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }


    

    public function notifyToDriver(User $driver){
        $passenger = auth()->user();
        try{
            TaxiCall::create([
                'driver_id' => $driver->id,
                'passenger_id' => $passenger->id,
            ]);

            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            $driver->notify(new SendPushNotification('Passenger Request',"{$passenger->name} called you as Taxi!",$fcmTokens));
            Alert::success("Dear {$passenger->name}", "we sent a notification to {$driver->name}");

        }catch(\Exception $e){
            Alert::error('Sorry!','there is some problems.');
        }
        
    
        return redirect()->back();
    }


    public function notifyToPassenger(User $passenger){
        $driver = auth()->user();
        try{
            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            $passenger->notify(new TaxiArrivedNotification('Driver Request',"Dear {$passenger->name} , {$driver->name} arrived to you!",$fcmTokens));
            Alert::success("Dear {$driver->name},","we Call {$passenger->name} to comes out!");
        }catch(\Exception $e){
            Alert::error('Sorry!','there is some problems.');
        }

        return redirect()->back();
    }


}

