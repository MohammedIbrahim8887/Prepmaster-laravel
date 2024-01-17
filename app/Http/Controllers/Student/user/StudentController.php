<?php

namespace App\Http\Controllers\Student\user;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\StudentSession;
use App\Http\Controllers\Sessions\user\StudentSessionController;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = Students::all();

        return response()->json(["message" => "Student retrieved successfully", "data" => $data], 200);
    }

    public function create(Request $request)
    {
        // Add your logic for displaying the create form
        $request->validate([
            "dept_id" => "required|numeric",
            "org_id" => "required|numeric",
            "fullName" => "required|string",
            "email" => "required|email",
            "password" => "required|string",
            "gender" => "required"
        ]);

        try {
            $student = Students::create($request->all());
            return response()->json(["message" => "Student Created Successfully", "data:" => $student], 200);
        } catch (ValidationException $e) {
            return response()->json(["message" => "Internal Server Error", "error" => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // Add your logic for storing a new item
    }

    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = Students::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Student retrieved successfully", "data" => $data], 200);
    }

    public function edit($id)
    {
        // Add your logic for displaying the edit form
    }

    public function updateProfile(Request $request, $id)
    {
        $isOwner = StudentSessionController::isOwner($request, $id);

        if (!$isOwner) {
            return response()->json(["message: " => "Unauthorized"], 404);
        }

        $student = Students::find($id);

        if (!$student) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        try {
            $request->validate([
                'fullName' => 'required|string',
                'phoneNumber' => 'required|string',
                'gender' => 'required|string',
                'email' => 'required|email',
            ]);

            $student->fullName = $request->input('fullName');
            $student->phoneNumber = $request->input('phoneNumber');
            $student->gender = $request->input('gender');
            $student->email = $request->input('email');

            $student->save();

            return response()->json(['message' => 'Student profile updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }


    public function updatePassword(Request $request, $id)
    {
        $isOwner = StudentSessionController::isOwner($request, $id);

        if (!$isOwner) {
            return response()->json(["message: " => "Unauthorized"], 404);
        }

        $student = Students::find($id);

        if (!$student) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        try {
            $request->validate([
                'password' => 'required|string'
            ]);

            $student->password = $request->input('password');

            $student->save();

            return response()->json(['message' => 'Student password updated successfully'], 200);
        }  catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        $isOwner = StudentSessionController::isOwner($request, $id);

        if (!$isOwner) {
            return response()->json(["message: " => "Unauthorized"], 404);
        }
        
        try {
            $data = Students::find($id);

            if (!$data) {
                return response()->json(["message: " => "Record not found"], 404);
            }

            Log::info("Requested ID: $id");

            $data->delete();

            return response()->json(["message" => "Student deleted successfully"], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
