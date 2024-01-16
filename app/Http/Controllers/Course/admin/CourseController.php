<?php

namespace App\Http\Controllers\Course\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        // Add your logic for listing items
        $data = Course::all();

        return response()->json($data);
    }

    public function create()
    {
        // Add your logic for displaying the create form
    }

    public function store(Request $request)
    {
        // Add your logic for storing a new item
    }

    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = Course::find($id);

        if(!$data){
            return response()->json(["message: " => "Record not found"],404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message: " => "Course  get successfully", $data],200);
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
