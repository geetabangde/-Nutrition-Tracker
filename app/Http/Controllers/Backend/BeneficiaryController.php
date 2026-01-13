<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Child;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    
    public function index()
    {
        $beneficiaries = Beneficiary::with('child')->latest()->get();
        return view('admin.beneficiaries.index', compact('beneficiaries'));
    }

    
    public function create()
    {
        $children = Child::orderBy('child_name')->get();
        return view('admin.beneficiaries.create', compact('children'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'child_id' => 'required|exists:children,id',
            'monitoring_date' => 'required|date',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'muac' => 'nullable|numeric',
            'bilateral_pitting_edema' => 'nullable|boolean',
        ]);

        
        $data['bilateral_pitting_edema'] = $request->has('bilateral_pitting_edema') ? 1 : 0;

        Beneficiary::create($data);

        return redirect()->route('admin.beneficiaries.index')
            ->with('success', 'Health record added successfully');
    }

    
    public function edit($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $children = Child::orderBy('child_name')->get();
        return view('admin.beneficiaries.edit', compact('beneficiary', 'children'));
    }

    
    public function update(Request $request, $id)
    {
        $beneficiary = Beneficiary::findOrFail($id);

        $data = $request->validate([
            'child_id' => 'required|exists:children,id',
            'monitoring_date' => 'required|date',
            'weight' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'muac' => 'nullable|numeric|min:0',
            'bilateral_pitting_edema' => 'nullable|in:0,1',
        ]);

        // Handle checkbox properly
        $data['bilateral_pitting_edema'] = $request->input('bilateral_pitting_edema', 0);

        $beneficiary->update($data);

        return redirect()->route('admin.beneficiaries.index')
            ->with('success', 'Health record updated successfully');
    }


    public function destroy($id)
    {
        Beneficiary::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Beneficiary Deleted');
    }
}