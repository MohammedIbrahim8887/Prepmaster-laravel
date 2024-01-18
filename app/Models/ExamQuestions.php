<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestions extends Model
{
    use HasFactory;

    protected $fillable = [
        "question_id",
        "exam_id"
    ];

    public function questions()
    {
        return $this->hasMany(Questions::class, "id", "question_id");
    }

    public function exams()
    {
        return $this->hasMany(Exams::class, "id", "exam_id");
    }
}
