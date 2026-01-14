<?php

namespace App\Http\Controllers;
use App\Models\User; 
use Illuminate\Http\Request;

class ProjectManagerDashboardController extends Controller
{
    public function index()
    { 
        $userCount = User::count(); 
        return view('project-manager.dashboard', compact('userCount'));  
    }
}