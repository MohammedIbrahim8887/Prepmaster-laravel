<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "name",
        "total_question",
        "time",
        "course_id"
    ];

    private function exam_questions()
    {
        return $this->hasMany(ExamQuestions::class, "question_id", "id");
    }
}
