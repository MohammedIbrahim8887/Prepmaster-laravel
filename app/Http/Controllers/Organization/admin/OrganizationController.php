<?php

namespace App\Http\Controllers\Organization\admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = Organization::all();

        return response()->json(["message" => "Organization retrieved successfully", "data" => $data], 200);
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

    public function updateProfile(Request $request, $id)
    {
        $data = Organization::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");


        try {
            $request->validate([
                'name' => 'required|string',
                'phoneNumber' => 'required|unique:organizations|string',
                'email' => 'required|email|unique:organizations|string',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'brandColor' => 'required|string',
            ]);

            $data->name = $request->input('name');
            $data->phoneNumber = $request->input('phoneNumber');
            $data->email = $request->input('email');
            $data->logo = $request->input('logo');
            $data->brandColor = $request->input('brandColor');

            $data->save();

            return response()->json(['message' => 'Organization updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }



    public function updatePassword(Request $request, $id)
    {
        $data = Organization::find($id);

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

            return response()->json(['message' => 'Organization password updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'.$e], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Organization::find($id);

            if (!$data) {
                return response()->json(["message: " => "Record not found"], 404);
            }

            Log::info("Requested ID: $id");

            $data->delete();

            return response()->json(["message" => "Organization deleted successfully"], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

}
