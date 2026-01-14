<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StateManagerController extends Controller
{
    
    public function createStateManager()
    {
        return view('admin.state-manager.create'); 
    }
    
    public function editStateManager($id){
        $stateManager = Admin::find($id);
        if (!$stateManager) {
            return redirect()->route('admin.state-manager.list')->with('error', 'State Manager not found');
        }
        return view('admin.state-manager.edit', compact('stateManager'));
    }
    // Update a state manager
    public function updateStateManager(Request $request, $id)
    {
        
        $statemanager = Admin::find($id); 
        $statemanager->name = $request->name;
        $statemanager->email = $request->email;
        $statemanager->address = $request->address;
        $statemanager->mobile_number = $request->mobile_number;
        
        $statemanager->save();
        return redirect()->route('admin.state-manager.list')->with('success', 'State Manager updated successfully.');
    }

    // Store a new state manager
    public function storeStateManager(Request $request)
    {
    
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required', 
            'mobile_number' => 'required|string|max:20',
        ]);

        
        $stateManager = Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'address'  => $request->address, 
            'mobile_number' => $request->mobile_number,
            'role_id'  => 2, // role_id = 2 for state managers
        ]);

        // Dump the created model to check
        // dd($stateManager);
        
        return redirect()->route('admin.state-manager.list')->with('success', 'State Manager created successfully.');
        
    }
    // List all state managers
    public function listStateManagers()
    {
        $stateManagers = Admin::where('role_id', 2)->get(); // role_id = 2 for state managers
        return view('admin.state-manager.list', compact('stateManagers'));
    }

    // delete state manager

    public function deleteStateManager($id){
        $stateManager = Admin::find($id);
        if($stateManager){
            $stateManager->delete();
            return redirect()->route('admin.state-manager.list')->with('success', 'State Manager deleted successfully.');
        }
        return redirect()->route('admin.state-manager.list')->with('error', 'State Manager not found.');
    }
}