<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\JoinedEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function get_analytics() 
    {

        $male_count = User::where('gender','MALE')->count();
        $female_count = User::where('gender','FEMALE')->count();
        $unspecified_count = User::where('gender',NULL)->count();

        $event_pending = Event::where('created_by',Auth::user()->id)->where('status','PENDING')->count();
        $event_ongoing = Event::where('created_by',Auth::user()->id)->where('status','ONGOING')->count();
        $event_finished= Event::where('created_by',Auth::user()->id)->where('status','FINISHED')->count();



        return response()->json([
            'genders' => [$male_count, $female_count, $unspecified_count],
            'events' => [$event_pending, $event_ongoing, $event_finished],

        ],200);
        
    }
    
}
