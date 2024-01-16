<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'question',
        'choices',
        'answer',
        'explanation',
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function getCorrectAnswerAttribute()
    {
        $choices = json_decode($this->attributes['choices'], true);
        $correctIndex = array_search($this->attributes['answer'], $choices);

        if ($correctIndex !== false) {
            return $choices[$correctIndex];
        }

        // Throw an exception if the correct choice is not found
        throw new \RuntimeException('Correct choice not found for question ID: ' . $this->id);
    }

}
