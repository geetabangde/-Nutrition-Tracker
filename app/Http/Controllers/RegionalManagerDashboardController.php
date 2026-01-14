<?php

namespace App\Http\Controllers;
use App\Models\User; 
use Illuminate\Http\Request;

class RegionalManagerDashboardController extends Controller
{
    public function index()
    { 
        $userCount = User::count(); 
        return view('regional-manager.dashboard', compact('userCount'));  
    }
}