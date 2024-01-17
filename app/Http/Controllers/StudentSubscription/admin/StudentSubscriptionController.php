<?php

namespace App\Http\Controllers\Studentubscription\admin;

use App\Http\Controllers\Controller;
use App\Models\StudentSubscription;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class StudentSubscriptionController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = StudentSubscription::all();

        return response()->json(["message" => "Student Subscription retrieved successfully", "data" => $data], 200);
    }

    public function create(Request $request)
    {
        // Add your logic for displaying the create form
        $request->validate([
            "subscription_id" => "required",
            "student_id" => "required",
            "start_date" => "required",
            "end_date" => "required",
        ]);

        try {
            $subscription_id = Subscriptions::find($request->subscription_id);
            if (empty($subscription_id)) {
                return response()->json(["message" => "Subscription does not exist"], 404);
            }
            $type = "organization";
            $status = "Active";
            $studentSubscription = new StudentSubscription([
                "subscription_id" => $subscription_id,
                "student_id" => $request->input("student_id"),
                "type" => $type,
                "status" => $status,
                "start_date" => $request->input("start_date"),
                "end_date" => $request->input("end_date"),
            ]);

            $studentSubscription->save();

            return response()->json(["message:" => "Student Subscription Created Successfully", "data:" => $studentSubscription], 200);
        } catch (ValidationException $e) {
            return response()->json(["message:" => "Internal Server Error", "error:" => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // Add your logic for storing a new item
    }

    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = StudentSubscription::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Student Subscription retrieved successfully", "data" => $data], 200);
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
