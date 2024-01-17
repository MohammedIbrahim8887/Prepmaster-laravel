<?php

namespace App\Http\Controllers\Promotion\admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = Promotion::all();

        return response()->json(["message" => "Promotions retrieved successfully", "data" => $data], 200);
    }

    public function create()
    {
        // Add your logic for displaying the create form
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data for form data
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size as needed
                'video' => 'required|string', // Adjust the file types and size as needed
            ]);
        } catch (\Exception $e) {
            // Handle validation errors and return a specific error response
            return response()->json(['error' => 'Validation failed. Please check your input.'], 422);
        }

        try {
            // Handle file uploads
            $posterPath = $request->file('poster')->store('posters', 'public');
            // $videoPath = $request->file('video')->store('videos', 'public');
        } catch (\Exception $e) {
            // Handle file upload errors
            return response()->json(['error' => 'File upload failed. Please check your files and try again.'], 500);
        }

        try {
            // Create a new promotion instance
            $promotion = new Promotion([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'poster' => $posterPath,
                'video' => $request->input('video'),
            ]);

            // Save the promotion to the database
            $promotion->save();

            // Return a success response
            return response()->json(['message' => 'Promotion created successfully'], 201);
        } catch (\Exception $e) {
            // Handle other unexpected errors during data saving
            return response()->json(['error' => 'Something went wrong while saving the promotion. Please try again.'], 500);
        }
    }


    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = Promotion::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Promotions retrieved successfully", "data" => $data], 200);
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
