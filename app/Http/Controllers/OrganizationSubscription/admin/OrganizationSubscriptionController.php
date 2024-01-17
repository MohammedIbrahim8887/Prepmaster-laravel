<?php

namespace App\Http\Controllers\OrganizationSubscription\admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationSubscription;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OrganizationSubscriptionController extends Controller
{
    //

    public function index()
    {
        // Add your logic for listing items
        $data = OrganizationSubscription::all();

        return response()->json(["message" => "Organization SUbscription retrieved successfully", "data" => $data], 200);
    }

    public function create(Request $request)
    {
        // Add your logic for displaying the create form
        $request->validate([
            "subscription_id" => "required",
            "org_id" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "mau" => "required",
        ]);

        try {

            $subscription_id = Subscriptions::find($request->subscription_id);
            if (empty($subscription_id)) {
                return response()->json(["message" => "Subscription does not exist"], 404);
            }
            $type = "organization";
            $status = "Active";
            $organizationSubscription = new OrganizationSubscription([
                "subscription_id" => $request->input('subscription_id'),
                'org_id' => $request->input('org_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'mau' => $request->input('mau'),
                'type' => $type,
                'status' => $status,
            ]);

            $organizationSubscription->save();

            return response()->json(['message' => 'Organization Subscription created successfully', 'data' => $organizationSubscription], 200);
        } catch (ValidationException $e) {
            return response()->json(["message" => "Internal Server Error", "error" => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // Add your logic for storing a new item
    }

    public function show($id)
    {
        // Add your logic for displaying a single item
        $data = OrganizationSubscription::find($id);

        if (!$data) {
            return response()->json(["message: " => "Record not found"], 404);
        }
        Log::info("Requested ID: $id");

        return response()->json(["message" => "Organization SUbscription retrieved successfully", "data" => $data], 200);
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
