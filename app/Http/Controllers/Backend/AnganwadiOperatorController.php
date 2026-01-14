<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AnganwadiOperatorController extends Controller
{
    // Create form
    public function createAnganwadiOperator()
    {
        $projectManagers = Admin::where('role_id', 4)->get();
        return view('admin.anganwadi-operator.create', compact('projectManagers'));
    }

    // Store
    public function storeAnganwadiOperator(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:admins,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
            'mobile_number' => 'required|string|max:20',
        ]);

        Admin::create([
            'project_id' => $request->project_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
            'role_id' => 5, // Anganwadi Operator
        ]);

        return redirect()
            ->route('admin.anganwadi-operator.list')
            ->with('success', 'Anganwadi Operator created successfully.');
    }

    // List
    public function listAnganwadiOperators()
    {
        $anganwadiOperators = Admin::where('role_id', 5)->get(); // Anganwadi
        $projectManagers    = Admin::where('role_id', 4)->get(); // Project
        $regionalManagers   = Admin::where('role_id', 3)->get(); // Regional
        $stateManagers      = Admin::where('role_id', 2)->get(); // State

        return view(
            'admin.anganwadi-operator.list',
            compact(
                'anganwadiOperators',
                'projectManagers',
                'regionalManagers',
                'stateManagers'
            )
        );
    }


    // Edit
    public function editAnganwadiOperator($id)
    {
        $anganwadiOperator = Admin::where('role_id', 5)->findOrFail($id);
        $projectManagers = Admin::where('role_id', 4)->get();

        return view(
            'admin.anganwadi-operator.edit',
            compact('anganwadiOperator', 'projectManagers')
        );
    }

    // Update
    public function updateAnganwadiOperator(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required|exists:admins,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'mobile_number' => 'required|string|max:20',
        ]);

        $anganwadiOperator = Admin::where('role_id', 5)->findOrFail($id);

        $anganwadiOperator->update([
            'project_id' => $request->project_id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
        ]);

        return redirect()
            ->route('admin.anganwadi-operator.list')
            ->with('success', 'Anganwadi Operator updated successfully.');
    }

    // Delete
    public function deleteAnganwadiOperator($id)
    {
        $anganwadiOperator = Admin::where('role_id', 5)->findOrFail($id);
        $anganwadiOperator->delete();

        return redirect()
            ->route('admin.anganwadi-operator.list')
            ->with('success', 'Anganwadi Operator deleted successfully.');
    }
}
