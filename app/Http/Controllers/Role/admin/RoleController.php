<?php

namespace App\Http\Controllers\Role\admin;

use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = Role::with('permissions')->get();

        return response()->json(["message" => "Roles retrieved successfully", "data" => $data], 200);
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
                'permission_ids' => 'required|array',
                'permission_ids.*' => 'required|numeric|exists:permissions,id'
            ]);

            // Create a new role instance
            $role = new Role([
                'name' => $request->input('name'),
            ]);

            // Save the role to the database
            $role->save();

            // Attach permissions to the role
            $role->permissions()->attach($request->input('permission_ids'));

            // Return a success response
            return response()->json(['message' => 'Role created successfully'], 201);
        } catch (\Exception $e) {
            // Log the exception for further investigation
            \Log::error($e);

            // Handle the exception and return a response
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
        $role = Role::find($id);

        if (!$role) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");


        try {
            $request->validate([
                'name' => 'required|string',
                'permission_id' => 'required|numeric|exists:permissions,id'
            ]);

            $role->name= $request->input('name');
            $role->permission_id= $request->input('permission_id');

            $role->save();

            return response()->json(['message' => 'Role updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Role::find($id);

            if (!$data) {
                return response()->json(["message: " => "Record not found"], 404);
            }

            Log::info("Requested ID: $id");

            $data->delete();

            return response()->json(["message" => "Role deleted successfully"], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
