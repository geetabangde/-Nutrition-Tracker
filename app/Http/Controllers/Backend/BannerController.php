<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    
    public function index()
    {
        $banners = Banner::latest()->get();
        
        $banners->map(function ($banner) {
            if ($banner->image) {
                $banner->image = url($banner->image);
            }
            return $banner;
        });

        return view('admin.banners.index', compact('banners'));
    }
    
    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $imageName = time().'_'.$request->image->getClientOriginalName();
        $request->image->move(public_path('uploads/banners'), $imageName);

        Banner::create([
            'title'  => $request->title,
            'image'  => 'uploads/banners/'.$imageName,
            'status' => $request->status ?? 1
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner Added Successfully');
    }

    
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->image = $banner->image ? url($banner->image) : null;
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        if ($request->hasFile('image')) {
            
            if ($banner->image && File::exists(public_path($banner->image))) {
                File::delete(public_path($banner->image));
            }

            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/banners'), $imageName);
            $banner->image = 'uploads/banners/'.$imageName;
        }

        $banner->title  = $request->title;
        $banner->status = $request->status;
        $banner->save();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner Updated Successfully');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image && File::exists(public_path($banner->image))) {
            File::delete(public_path($banner->image));
        }
        $banner->delete();
        return redirect()->back()->with('success', 'Banner Deleted');
    }
    
    public function changeStatus($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = $banner->status ? 0 : 1;
        $banner->save();
        return redirect()->back();
    }
}