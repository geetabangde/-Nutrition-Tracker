<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AnganwadiAuthController extends Controller
{
    /* =====================================================
       1️⃣ SEND OTP (Login with Mobile)
    ===================================================== */
    public function loginWithMobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // 🔍 Only Anganwadi user
        $admin = Admin::where('mobile_number', $request->mobile_number)
            ->where('role_id', 5)
            ->first();

        if (!$admin) {
            return response()->json([
                'status'  => false,
                'message' => 'Mobile number not registered'
            ], 404);
        }

        // 🔢 Generate OTP
        $otp = rand(100000, 999999);

        // 🔴 IMPORTANT: update() ke baad check karo
        $updated = Admin::where('id', $admin->id)->update([
            'otp' => $otp
        ]);

        if (!$updated) {
            return response()->json([
                'status' => false,
                'message' => 'OTP not saved in database'
            ], 500);
        }


        return response()->json([
            'status'  => true,
            'message' => 'OTP sent successfully',
            // ❌ Production me OTP mat bhejna
            'otp'     => $otp
        ], 200);
    }

    /* =====================================================
       2️⃣ VERIFY OTP
    ===================================================== */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|string|max:20',
            'otp'           => 'required|digits:6'
        ]);

        $admin = Admin::where('mobile_number', $request->mobile_number)
            ->where('role_id', 5)
            ->first();

        if (!$admin) {
            return response()->json([
                'status'  => false,
                'message' => 'User not found'
            ], 404);
        }

        if ($admin->otp !== $request->otp) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid OTP'
            ], 401);
        }

        // 🧹 Clear OTP
        $admin->update([
            'otp' => null
        ]);


        // 🔐 Create Sanctum Token
        $token = $admin->createToken('anganwadi-token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'OTP verified successfully',
            'token'   => $token,
            'data'    => [
                'id'     => $admin->id,
                'name'   => $admin->name,
                'mobile' => $admin->mobile_number,
                'role'   => 'Anganwadi Operator'
            ]
        ], 200);
    }
}