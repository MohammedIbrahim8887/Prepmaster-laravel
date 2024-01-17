<?php

namespace App\Http\Controllers\Sessions\user;

use App\Models\Students;
use App\Models\StudentSession;
use Error;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentSessionController extends Controller
{
    public function generateToken(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        try {
            $student = Students::where("email", $request->email)->first();

            if (!$student || !($student->password == $request->password)) {
                return response()->json(["message:" => "Invalid Credentials"], 401);
            }

            $token = $student->createToken("api-token")->plainTextToken;
            $studentSession = new StudentSession(['student_id' => $student->id, 'token' => $token]);
            $studentSession->save();
            return response()->json(["Session:" => $studentSession], 200);
        } catch (Error $e) {
            return response()->json(['message:' => "Internal Server Error", "error" => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->validate([
            "token" => "required|string"
        ]);

        try {
            $studentSession = StudentSession::where("token", $request->token)->first();

            if (!$studentSession) {
                return response()->json(["message" => "Invalid Session Token"], 404);
            }

            StudentSession::destroy($studentSession->id);
            return response()->json(["message" => "User logged out successfully"], 200);
        } catch (Error $e) {
            return response()->json(["message:" => "Internal Server Error", "error:" => $e->getMessage()], 500);
        }
    }
}
