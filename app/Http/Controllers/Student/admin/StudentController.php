<?php

namespace App\Http\Controllers\Student\admin;

use App\Http\Controllers\Controller;
use App\Models\Students;
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
        // Validate the incoming request data
        $request->validate([
            'dept_id' => 'required|numeric|exists:departments,id',
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

    public function update(Request $request, $id)
    {
        // Add your logic for updating an item
    }

    public function destroy($id)
    {
        // Add your logic for deleting an item
    }
}
