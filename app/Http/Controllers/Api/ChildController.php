<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;

class ChildController extends Controller
{
    public function index()
    {
        $children = Child::select(
            'id','child_code','child_name','age','gender',
            'mother_name','father_name','anganwadi_center','image'
        )->latest()->get();


        return response()->json([
            'status' => true,
            'message' => 'Children list fetched successfully',
            'data' => $children
        ], 200);
    }
}