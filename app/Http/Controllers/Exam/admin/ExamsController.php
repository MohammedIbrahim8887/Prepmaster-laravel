<?php

namespace App\Http\Controllers\Exam\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamsControllerRequest;
use App\Http\Requests\UpdateExamsControllerRequest;
use App\Models\AdminSession;
use App\Models\ExamQuestions;
use App\Models\Exams;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $token = $request->bearerToken();
        $adminSession = AdminSession::where("token", $token)->first();

        if (empty($adminSession)) {
            return response()->json(["message" => "Session Not Found", $token], 404);
        }

        try {
            $exams = Exams::all();
            if (!empty($exams)) {
                return response()->json(["message" => "No exams found"], 404);
            }
            return response()->json(["message" => "All exams succesffully get", "data" => $exams], 200);
        } catch (ValidationException $e) {
            return response()->json(["message" => "Internal Server Error", "errror" => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            "name" => "required|string",
            "total_question" => "required",
            "time" => "required",
            "course_id" => "required"
        ]);

        $token = $request->bearerToken();
        $adminSession = AdminSession::where("token", $token)->first();

        if (empty($adminSession)) {
            return response()->json(["message" => "Session Not Found"], 404);
        }

        try {
            $exams = new Exams([
                "name" => $request->name,
                "course_id" => $request->course_id,
                "total_question" => $request->total_question,
                "time" => $request->time,
            ]);
            $exams->save();
            return response()->json(["message" => "Exam created successfully", "" => $exams], 200);
        } catch (ValidationException $e) {
            return response()->json(["message" => "Internal Server Error", "error" => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamsControllerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the exam
        $exam = Exams::find($id);

        if (empty($exam)) {
            return response()->json(["message" => "Exam does not exist"], 404);
        }

        // Get exam questions with related questions
        $examQuestions = ExamQuestions::with('questions')->where("exam_id", $exam->id)->get();

        return response()->json(["message" => "Exam get successfully", "data" => $examQuestions], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exams $examsController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamsControllerRequest $request, Exams $examsController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exams $examsController)
    {
        //
    }
}
