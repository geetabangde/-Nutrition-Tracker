<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Admin;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {   
        $userCount = User::count(); 
        $bannerCount = Banner::count();
        return view('admin.dashboard', compact('userCount', 'bannerCount'));
    }

    
}