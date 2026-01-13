<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    // LIST
    public function index()
    {
        $children = Child::latest()->get();
        return view('admin.children.index', compact('children'));
    }

    // CREATE FORM
    public function create()
    {
        return view('admin.children.create');
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'child_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required',
            'mother_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'anganwadi_center' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nutrition_status' => 'nullable|string',
        ]);

        // 🔹 AUTO CHILD CODE GENERATION (AW1029)
        $lastChild = Child::orderBy('id', 'desc')->first();
        $nextNumber = $lastChild ? ((int) substr($lastChild->child_code, 2) + 1) : 1001;
        $data['child_code'] = 'AW' . $nextNumber;

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/child'), $imageName);
            $data['image'] = 'uploads/child/'.$imageName;
        }

        Child::create($data);

        return redirect()->route('admin.children.index')
            ->with('success', 'Child Added Successfully');
    }


    // EDIT
    public function edit($id)
    {
        $child = Child::findOrFail($id);
        return view('admin.children.edit', compact('child'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $child = Child::findOrFail($id);
        $data = $request->validate([
            'child_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required',
            'mother_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'anganwadi_center' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nutrition_status' => 'nullable|string',
        ]);

        // IMAGE UPDATE
        if ($request->hasFile('image')) {
            if ($child->image && file_exists(public_path($child->image))) {
                unlink(public_path($child->image));
            }

            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/child'), $imageName);
            $data['image'] = 'uploads/child/'.$imageName;
        }
        $child->update($data);
        return redirect()->route('admin.children.index')
            ->with('success', 'Child Updated Successfully');
    }

    // DELETE
    public function destroy($id)
    {
        $child = Child::findOrFail($id);
        if ($child->image && file_exists(public_path($child->image))) {
            unlink(public_path($child->image));
        }
        $child->delete();
    
        return redirect()->back()->with('success', 'Child Deleted');

        
    }
}