<?php

namespace App\Http\Controllers\Student\user;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Error;
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
        } catch (Error $e) {
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

    public function update(Request $request, $id)
    {
        // Add your logic for updating an item
    }

    public function destroy($id)
    {
        // Add your logic for deleting an item
    }
}
