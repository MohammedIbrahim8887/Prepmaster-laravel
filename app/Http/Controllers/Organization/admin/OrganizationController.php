<?php

namespace App\Http\Controllers\Organization\admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OrganizationController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = Organization::all();

        return response()->json(["message" => "Organization retrieved successfully", "data" => $data], 200);
    }

    public function create(Request $request)
    {
        // Add your logic for displaying the create form
        $request->validate([
            "name" => "required|string",
            "phoneNumber" => "required|string",
            "email" => "required|email",
            "password" => "required|string",
            "logo" => "required",
            "brandColor" => "required",
        ]);

        try {
            $organization = Organization::create($request->all());
            return response()->json(["message" => "Student Created Successfully", "data:" => $organization], 200);
        } catch (ValidationException $e) {
            return response()->json(["message" => "Internal Server Error", "error:" => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string',
                'phoneNumber' => 'required|unique:organizations|string',
                'email' => 'required|email|unique:organizations|string',
                'password' => 'required|string',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'brandColor' => 'required|string',
            ]);

            // Handle file upload (logo)
            $logoPath = $request->file('logo')->store('logos', 'public');

            // Create a new organization instance
            $organization = new Organization([
                'name' => $request->input('name'),
                'phoneNumber' => $request->input('phoneNumber'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'logo' => $logoPath,
                'brandColor' => $request->input('brandColor'),
            ]);

            // Save the organization
            $organization->save();

            // Return a success response
            return response()->json(['message' => 'Organization created successfully'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Other exceptions
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = Organization::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Organization retrieved successfully", "data" => $data], 200);
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
