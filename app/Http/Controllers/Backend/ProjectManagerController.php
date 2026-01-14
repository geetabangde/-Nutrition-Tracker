<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class ProjectManagerController extends Controller
{
    // Create form
    public function createProjectManager()
    {
        $regionalManagers = Admin::where('role_id', 3)->get();
        return view('admin.project-manager.create', compact('regionalManagers'));
    }

    // Store
    public function storeProjectManager(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
            'mobile_number' => 'required|string|max:20',
            'regional_id' => 'required|exists:admins,id',
        ]);

        Admin::create([
            'regional_id' => $request->regional_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
            'role_id' => 4,
        ]);

        return redirect()->route('admin.project-manager.list')
            ->with('success', 'Project Manager created successfully.');
    }

    // List
    public function listProjectManagers()
    {
        $states = Admin::where('role_id', 2)->get();          // State Managers
        $regionalManagers = Admin::where('role_id', 3)->get(); // Regional Managers
        $projectManagers = Admin::where('role_id', 4)->get();  // Project Managers

        return view(
            'admin.project-manager.list',
            compact('projectManagers', 'regionalManagers', 'states')
        );
    }


    // Edit
    public function editProjectManager($id)
    {
        $projectManager = Admin::findOrFail($id);
        $regionalManagers = Admin::where('role_id', 3)->get();
        return view('admin.project-manager.edit', compact('projectManager', 'regionalManagers'));
    }

    // Update
    public function updateProjectManager(Request $request, $id)
    {
        $request->validate([
            'regional_id' => 'required|exists:admins,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'mobile_number' => 'required|string|max:20',
        ]);

        $projectManager = Admin::findOrFail($id);

        $projectManager->update([
            'regional_id' => $request->regional_id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
        ]);

        return redirect()->route('admin.project-manager.list')
            ->with('success', 'Project Manager updated successfully.');
    }

    // Delete
    public function deleteProjectManager($id)
    {
        $projectManager = Admin::findOrFail($id);
        $projectManager->delete();
        
        return redirect()->route('admin.project-manager.list')
            ->with('success', 'Project Manager deleted successfully.');
    }
}
