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
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'phoneNumber' => 'required|unique:organizations|string',
            'email' => 'required|email|unique:organizations|string',
            'password' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brandColor' => 'required|string',
        ]);

        // Get the authenticated user using the bearer token
        $user = Auth::user();

        // Handle file upload (logo)
        $logoPath = $request->file('logo')->store('logos', 'public');

        // Create a new organization instance
        $organization = new Organization([
            'name' => $request->input('name'),
            'phoneNumber' => $request->input('phoneNumber'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'logo' => $logoPath,
            'brandColor' => $request->input('brandColor'),
        ]);

        // Associate the organization with the authenticated user
        $user->organization()->save($organization);

        // Return a success response
        return response()->json(['message' => 'Organization created successfully'], 201);
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
