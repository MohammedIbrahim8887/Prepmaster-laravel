<?php

namespace App\Http\Controllers\Student\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSession;
use App\Models\Students;
use App\Models\StudentSession;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = Students::all();

        return response()->json(["message" => "Student retrieved successfully", "data" => $data], 200);
    }

    public function create()
    {
        // Add your logic for displaying the create form
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'dept_id' => 'required|string|exists:departments,id',
                'fullName' => 'required|string',
                'phoneNumber' => 'required|string',
                'gender' => 'required|string',
                'password' => 'required|string',
                'email' => 'required|email',
            ]);

            // Create a new student instance
            $student = new Students([
                'dept_id' => $request->input('dept_id'),
                'fullName' => $request->input('fullName'),
                'phoneNumber' => $request->input('phoneNumber'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'gender' => $request->input('gender'),
            ]);

            // Save the student to the database
            $student->save();

            // Return a success response
            return response()->json(['message' => 'Student created successfully'], 201);
        } catch (QueryException $e) {
            // Handle the exception when an invalid department ID is provided
            return response()->json(['error' => 'Invalid department ID. Please provide a valid department ID.'], 400);
        } catch (\Exception $e) {
            // Handle other generic exceptions
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
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

    public function updateProfileByStudent(Request $request, $id)
    {
        //verify student who is updating the account is the owner of the account
        $studentSessions = StudentSession::where('student_id', $id)->get();
        $token = request()->header('Authorization');
        $token = str_replace('Bearer ', '', $token);

        // Check if the token matches any of the associated StudentSession tokens
        $isLoggedInStudent = $studentSessions->contains('token', $token);

        if (!$isLoggedInStudent) {
            return response()->json(["message" => "Unauthorized"], 404);
        }

        // Token is valid, proceed with the destroy operation
        $this->updateProfile($request, $id);

    }

    public function updateProfile(Request $request, $id)
    {
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
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }


    public function updatePassword(Request $request, $id)
    {
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
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function destroyByStudent(Request $request, $id)
    {
        //verify student who is deleting the account is the owner of the account
        $studentSessions = StudentSession::where('student_id', $id)->get();
        $token = request()->header('Authorization');
        $token = str_replace('Bearer ', '', $token);

        // Check if the token matches any of the associated StudentSession tokens
        $isLoggedInStudent = $studentSessions->contains('token', $token);

        if (!$isLoggedInStudent) {
            return response()->json(["message" => "Unauthorized"], 404);
        }

        // Token is valid, proceed with the destroy operation
        $this->destroy($request, $id);

    }

    public function destroy(Request $request, $id)
    {
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
