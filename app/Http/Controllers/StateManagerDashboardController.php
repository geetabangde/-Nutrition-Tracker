<?php

namespace App\Http\Controllers;

use App\Models\User; 

use Illuminate\Http\Request;

class StateManagerDashboardController extends Controller
{
    public function index()
    { 
        $userCount = User::count(); 
        return view('state-manager.dashboard', compact('userCount'));  
    }
}
