<?php

namespace App\Http\Controllers\Role\admin;

use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = Role::all();

        return response()->json(["message" => "Role retrieved successfully", "data" => $data], 200);
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
                'name' => 'required|string',
                'permission_id' => 'required|numeric|exists:permissions,id'
            ]);

            // Create a new permission instance
            $permission = new Role([
                'name' => $request->input('name'),
                'permission_id' => $request->input('permission_id'),
            ]);

            // Save the permission to the database
            $permission->save();

            // Return a success response
            return response()->json(['message' => 'Permission created successfully'], 201);
        } catch (QueryException $e) {
            // Handle the exception when an invalid department ID is provided
            return response()->json(['error' => 'Invalid Permission ID. Please provide a valid permission ID.'], 400);
        } catch (\Exception $e) {
            // Handle other generic exceptions
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = Role::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Role retrieved successfully", "data" => $data], 200);
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
