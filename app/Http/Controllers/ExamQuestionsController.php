<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestions;
use App\Http\Requests\StoreExamQuestionsRequest;
use App\Http\Requests\UpdateExamQuestionsRequest;
use App\Models\AdminSession;
use Illuminate\Http\Request;

class ExamQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $examQuestions = ExamQuestions::all();

        if (empty($examQuestions)) {
            return response()->json(["message" => "No exams found"], 404);
        }

        return response()->json(["message" => "All Exams Get Successfully", $examQuestions], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //

        $token = $request->bearerToken();
        $adminSession = AdminSession::where("token", $token)->first();

        if (empty($adminSession)) {
            return response()->json(["message" => "Session Not Found"], 404);
        }

        $request->validate([
            "question_id" => "required|numeric",
            "exam_id" => "required|numeric"
        ]);

        $examQuestion = new ExamQuestions($request->all());
        $examQuestion->save();

        return response()->json(["message" => "Exam Questions created successfully", "data" => $examQuestion], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamQuestionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $examQuestion = ExamQuestions::find($id);

        if (empty($examQuestion)) {
            return response()->json(["message" => "Exam does not exist"], 404);
        }

        return response()->json(["message" => "Exam get successfully", "data" => $examQuestion], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamQuestions $examQuestions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamQuestionsRequest $request, ExamQuestions $examQuestions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamQuestions $examQuestions)
    {
        //
    }
}
