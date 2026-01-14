<?php

namespace App\Http\Controllers;
use App\Models\User; 
use Illuminate\Http\Request;

class AnganwadiOperatorDashboardController extends Controller
{
    public function index()
    { 
        $userCount = User::count(); 
        return view('anganwadi-operator.dashboard', compact('userCount'));  
    }
}