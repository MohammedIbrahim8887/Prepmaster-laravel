<?php

namespace App\Http\Controllers\Sessions\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Organization;
use App\Models\OrganizationSession;
use App\Models\AdminSession;
use Error;
use Illuminate\Http\Request;

class AdminSessionController extends Controller
{
    public function generateToken(Request $request)
    {
        // Validate the request (you may customize this based on your needs)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        try {
            // Attempt to authenticate the user
            $admin = Admin::where('email', $request->email)->first();
            $org = Organization::where('email', $request->email)->first();

            // Check if either an admin or an org user is found
            if (!$admin && !$org) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            // // Check if it's an admin user
            if ($admin && $request->password == $admin->password) {
                $token = $admin->createToken('api-token')->plainTextToken;
                $adminSession = new AdminSession([
                    'admin_id' => $admin->id,
                    'token' => $token,
                ]);
                $adminSession->save();
                return response()->json(['session:' => $adminSession]);
            }

            // // Check if it's an org user
            if ($org && $request->password == $org->password) {
                $token = $org->createToken('api-token')->plainTextToken;
                $orgSession = new OrganizationSession(['org_id' => $org->id, 'token' => $token]);
                return response()->json(['session:' => $orgSession]);
            }

            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (Error $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        // Validate the request (you may customize this based on your needs)
        $request->validate([
            'token' => 'required',
        ]);


        try {
            // Attempt to authenticate the user
            $admin = AdminSession::where('token', $request->token)->first();
            $org = OrganizationSession::where('token', $request->token)->first();

            // Check if either an admin or an org user is found
            if (!$admin && !$org) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            // // Check if it's an admin user
            if ($admin) {
                AdminSession::destroy($admin->id);
                return response()->json(['User logged out successfully']);
            }

            // // Check if it's an org user
            if ($org) {
                AdminSession::destroy($$org->id);
                return response()->json(['User logged out successfully']);
            }

            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (Error $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
