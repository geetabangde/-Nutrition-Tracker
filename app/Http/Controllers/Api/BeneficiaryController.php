<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'child_id' => 'required',
            'monitoring_date' => 'required|date',
            'weight' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'muac' => 'nullable|numeric|min:0',
            'bilateral_pitting_edema' => 'nullable|boolean',
        ]);

        $beneficiary = Beneficiary::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Beneficiary health record created successfully',
            'data' => $beneficiary
        ], 201);
    }
}