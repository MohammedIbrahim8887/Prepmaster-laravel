<?php

namespace App\Http\Controllers\Admin\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminSession;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function index()
    {
        // Add your logic for listing items
        $data = Admin::all();

        return response()->json(["message" => "Admins retrieved successfully", "admins" => $data], 200);
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
                'org_id' => 'required|numeric|exists:organizations,id',
                'name' => 'required|string',
                'description' => 'required|string',
            ]);

            // Create a new student instance
            $student = new Admin([
                'org_id' => $request->input('org_id'),
                'fullName' => 'required|string',
                'phoneNumber' => 'required|string',
                'gender' => 'required|string',
                'email' => 'required|email',
            ]);

            // Save the student to the database
            $student->save();

            // Return a success response
            return response()->json(['message' => 'Admin created successfully'], 201);
        } catch (QueryException $e) {
            // Handle the exception when an invalid department ID is provided
            return response()->json(['error' => 'Invalid Org ID or admin ID. Please provide a valid org ID .'], 400);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            // Handle other generic exceptions
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = Admin::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Admins retrieved successfully", "admin" => $data], 200);
    }

    public function confirmPassword(Request $request)
    {
        $request->validate([
            "password" => "required",
        ]);
        $token = $request->bearerToken();
        $adminSession = AdminSession::where("token", $token)->first();

        if (empty($adminSession)) {
            return response()->json(["message" => "Session Not Found"], 404);
        }

        $admin = Admin::find($adminSession->admin_id);

        if ($admin->password == $request->password) {
            return response()->json(["message" => "Password is the same "],200);
        } else {
            return response()->json(["message" => "Incorrect Password"],401);
        }
    }
    public function edit($id)
    {
        // Add your logic for displaying the edit form
    }

    public function updateProfile(Request $request, $id)
    {
        $data = Admin::find($id);

        if (!$data) {
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

            $data->fullName = $request->input('fullName');
            $data->phoneNumber = $request->input('phoneNumber');
            $data->gender = $request->input('gender');
            $data->email = $request->input('email');

            $data->save();

            return response()->json(['message' => 'Admin profile updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
    public function updatePassword(Request $request, $id)
    {

        $data = Admin::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        try {
            $request->validate([
                'password' => 'required|string'
            ]);

            $data->password = $request->input('password');

            $data->save();

            return response()->json(['message' => 'Admin password updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Admin::find($id);

            if (!$data) {
                return response()->json(["message: " => "Record not found"], 404);
            }

            Log::info("Requested ID: $id");

            $data->delete();

            return response()->json(["message" => "Admin deleted successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    // Add additional custom methods as needed
}
