<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
public function banners(Request $request)
{
    // Start query
    $query = Banner::where('status', 1)->orderBy('id', 'desc');

    // (Optional) filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $banners = $query->get();

    // Add full image path (same as product logic)
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