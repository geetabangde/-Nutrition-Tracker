<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
public function banners(Request $request)
{
    
    $query = Banner::where('status', 1)->orderBy('id', 'desc');
    
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $banners = $query->get();
    
    $banners = $banners->map(function ($banner) {
        if ($banner->image) {
            $banner->image = url('uploads/banners/' . rawurlencode(basename($banner->image)));
        }
        return $banner;
    });
    
    return response()->json([
        'status'  => true,
        'banners' => $banners
    ], 200);
}

}