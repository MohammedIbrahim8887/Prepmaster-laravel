<?php

namespace App\Http\Controllers\Question\admin;

use App\Http\Controllers\Controller;
use App\Models\Questions;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = Questions::all();

        return response()->json(["message" => "Questions retrieved successfully", "data" => $data], 200);
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
                'course_id' => 'required|exists:courses,id',
                'question' => 'required|string',
                'choices' => 'required|array|min:3', // Ensure at least 3 choices
                'choices.*' => 'string', // Each choice should be a string
                'answer' => 'required|string|in:' . implode(',', $request->input('choices')), // Ensure answer is one of the choices
                'explanation' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            // Handle validation errors and return a specific error response
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }

        try {
            // Create a new question instance
            $question = new Questions([
                'course_id' => $request->input('course_id'),
                'question' => $request->input('question'),
                'choices' => json_encode($request->input('choices')),
                'answer' => $request->input('answer'),
                'explanation' => $request->input('explanation'),
            ]);

            // Save the question to the database
            $question->save();

            // Return a success response
            return response()->json(['message' => 'Question created successfully'], 201);
        } catch (\Exception $e) {
            // Handle other unexpected errors during data saving
            return response()->json(['error' => 'Something went wrong while saving the question. Please try again.'], 500);
        }
    }

    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = Questions::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Questions retrieved successfully", "data" => $data], 200);
    }

    public function edit($id)
    {
        // Add your logic for displaying the edit form
    }

    public function update(Request $request, $id)
    {
        $data = Questions::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");


        try {
            $request->validate([
                'question' => 'required|string',
                'choices' => 'required|array|min:3', // Ensure at least 3 choices
                'choices.*' => 'string', // Each choice should be a string
                'answer' => 'required|string|in:' . implode(',', $request->input('choices')), // Ensure answer is one of the choices
                'explanation' => 'required|string',
            ]);

            $data->question = $request->input('question');
            $data->choices = $request->input('choices');
            $data->answer = $request->input('answer');
            $data->explanation = $request->input('explanation');

            $data->save();

            return response()->json(['message' => 'Question updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Questions::find($id);

            if (!$data) {
                return response()->json(["message: " => "Record not found"], 404);
            }

            Log::info("Requested ID: $id");

            $data->delete();

            return response()->json(["message" => "Question deleted successfully"], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
