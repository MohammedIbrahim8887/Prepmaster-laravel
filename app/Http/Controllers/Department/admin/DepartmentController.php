<?php

namespace App\Http\Controllers\Department\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    public function index()
    {
        // Add your logic for listing items
        $data = Department::all();

        return response()->json(["message" => "Department retrieved successfully", "data" => $data], 200);
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
                'admin_id' => 'required|numeric|exists:admins,id',
                'name' => 'required|string',
                'description' => 'required|string',
            ]);

            // Create a new student instance
            $student = new Department([
                'admin_id' => $request->input('admin_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            // Save the student to the database
            $student->save();

            // Return a success response
            return response()->json(['message' => 'Department created successfully'], 201);
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
        $data = Department::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Department retrieved successfully", "data" => $data], 200);
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

    // Add additional custom methods as needed
}
