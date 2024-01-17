<?php

namespace App\Http\Controllers\Course\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        // Add your logic for listing items
        $data = Course::all();

        return response()->json(["message" => "Course retrieved successfully", "data" => $data], 200);
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
                'dept_id' => 'required|numeric|exists:departments,id',
                'name' => 'required|string',
                'description' => 'required|string',
            ]);

            // Create a new student instance
            $student = new Course([
                'admin_id' => $request->input('admin_id'),
                'dept_id' => $request->input('admin_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            // Save the student to the database
            $student->save();

            // Return a success response
            return response()->json(['message' => 'Course created successfully'], 201);
        } catch (QueryException $e) {
            // Handle the exception when an invalid department ID is provided
            return response()->json(['error' => 'Invalid Department ID or Admin ID. Please provide a valid department ID or admin ID.'], 400);
        } catch (\Exception $e) {
            // Handle other generic exceptions
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }


    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = Course::find($id);

        if(!$data){
            return response()->json(["message: " => "Record not found"],404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Course retrieved successfully", "data" => $data], 200);
    }

    public function edit($id)
    {
        // Add your logic for displaying the edit form
    }

    public function update(Request $request, $id)
    {
        $data = Course::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");


        try {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
            ]);

            $data->name = $request->input('name');
            $data->description = $request->input('description');

            $data->save();

            return response()->json(['message' => 'Question updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Course::find($id);

            if (!$data) {
                return response()->json(["message: " => "Record not found"], 404);
            }

            Log::info("Requested ID: $id");

            $data->delete();

            return response()->json(["message" => "Course deleted successfully"], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    // Add additional custom methods as needed
}
