<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class HomeController extends Controller
{
    public function index() {
    	$notifications = Notification::where('user_id', '=', Auth::user()->id)
    		->where('read', '=', false)
    		->orderBy('created_at', 'DESC')->get();

        return view('index', compact('notifications'));
    }
}
