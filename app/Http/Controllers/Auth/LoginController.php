<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin; 



class LoginController extends Controller
{

    protected function guard()
    {
        return Auth::guard('admin');
    }
    
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
   {
        // Validate request data
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
          // Find user by email first
         $user = Admin::where('email', $request->email)->first();

        
        // Attempt login using admin guard (covers all roles)
            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
                $user = Auth::guard('admin')->user();

                // Role-based redirect
                switch ($user->role_id) {
                    case 1:
                        return redirect()->route('admin.dashboard');
                    case 2:
                        return redirect()->route('state.manager.dashboard');
                    case 3:
                        return redirect()->route('regional.manager.dashboard');
                    case 4:
                        return redirect()->route('project.manager.dashboard');
                    case 5:
                        return redirect()->route('anganwadi.operator.dashboard');
                    default:
                        Auth::guard('admin')->logout();
                        return back()->withErrors(['email' => 'Unauthorized role.']);
                }
            }

        // Login failed
        return back()->withErrors(['email' => 'Invalid credentials.']);
   }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }
}