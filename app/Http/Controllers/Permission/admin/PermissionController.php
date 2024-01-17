<?php

namespace App\Http\Controllers\Permission\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = Permission::all();

        return response()->json(["message" => "Permissions retrieved successfully", "data" => $data], 200);
    }

    public function create()
    {
        // Add your logic for displaying the create form
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|unique:permissions',
        ]);

        // Create a new permission instance
        $permission = new Permission([
            'name' => $request->input('name'),
        ]);

        // Save the permission to the database
        $permission->save();

        // Return a success response
        return response()->json(['message' => 'Permission created successfully'], 201);
    }

    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = Permission::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Permissions retrieved successfully", "data" => $data], 200);
    }

    public function edit($id)
    {
        // Add your logic for displaying the edit form
    }

    public function update(Request $request, $id)
    {
        $data = Permission::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");


        try {
            $request->validate([
                'name' => 'required|string|unique:permissions',
            ]);

            $data->name = $request->input('name');

            $data->save();

            return response()->json(['message' => 'Permission updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Permission::find($id);

            if (!$data) {
                return response()->json(["message: " => "Record not found"], 404);
            }

            Log::info("Requested ID: $id");

            $data->delete();

            return response()->json(["message" => "Permission deleted successfully"], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
