<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RegionalManagerController extends Controller
{

    public function createRegionalManager()
    {   
        $states = DB::table('admins')->where('role_id', 2)->get();
        return view('admin.regional-manager.create', compact('states'));
    }
    
    public function editRegionalManager($id){
        $regionalManager = Admin::find($id);
        $states = DB::table('admins')->where('role_id', 2)->get();
        if (!$regionalManager) {
            return redirect()->route('admin.regional-manager.list')->with('error', 'Regional Manager not found');
        }
        return view('admin.regional-manager.edit', compact('regionalManager', 'states'));
    }
    // Update a regional manager
    public function updateRegionalManager(Request $request, $id)
    {
        $request->validate([
            'state_id' => 'required|exists:admins,id',
        ]);

        $regionalManager = Admin::findOrFail($id);

        $regionalManager->update([
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
        ]);

        return redirect()->route('admin.regional-manager.list')
            ->with('success', 'Regional Manager updated successfully.');
    }


    // Store a new regional manager
    public function storeRegionalManager(Request $request)
    {
    
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required', 
            'mobile_number' => 'required|string|max:20',
            'state_id' => 'required|exists:admins,id',
        ]);
        
        $regionalManager = Admin::create([
            'state_id' => $request->state_id,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'address'  => $request->address, 
            'mobile_number' => $request->mobile_number,
            'role_id'  => 3, // role_id = 3 for regional managers
        ]);

        // Dump the created model to check
        // dd($regionalManager);

        return redirect()->route('admin.regional-manager.list')->with('success', 'Regional Manager created successfully.');

    }
    // List all regional managers
    public function listRegionalManagers()
    {
        $regionalManagers = Admin::where('role_id', 3)->get(); // role_id = 3 for regional managers
        $states = DB::table('admins')->where('role_id', 2)->get();
        return view('admin.regional-manager.list', compact('regionalManagers', 'states'));
    }

    // delete regional manager

    public function deleteRegionalManager($id){
        $regionalManager = Admin::find($id);
        if($regionalManager){
            $regionalManager->delete();
            return redirect()->route('admin.regional-manager.list')->with('success', 'Regional Manager deleted successfully.');
        }
        return redirect()->route('admin.regional-manager.list')->with('error', 'Regional Manager not found.');
    }
}