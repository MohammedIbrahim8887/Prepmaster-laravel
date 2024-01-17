<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use App\Http\Requests\StoreSubscriptionsRequest;
use App\Http\Requests\UpdateSubscriptionsRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subscriptions = Subscriptions::all();

        if (empty($subscriptions)) {
            return response()->json(["message:" => "No Subscriptions Found"], 404);
        }

        return response()->json(["message:" => "All Subscriptions Get Successfully", "data:" => $subscriptions], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            "name" => "required",
            "monthly_price" => "required",
            "yearly_price" => "required",
            "type" => "required",
            "mau" => "nullable",
        ]);

        try {
            $subscriptions = Subscriptions::create($request->all());
            return response()->json(["message" => "Subscription created successfully", "data:" => $subscriptions], 200);
        } catch (ValidationException $e) {
            return response()->json(["message:" => "Internal Serevr Error", "error:" => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $subsciption = Subscriptions::find($id);

        if (empty($subsciption)) {
            return response()->json(["message" => "Subscription Not Found"], 404);
        }

        return response()->json(["message" => "Subscription get successfully", "data:" => $subsciption], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionsRequest $request, Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriptions $subscriptions)
    {
        //
    }
}
