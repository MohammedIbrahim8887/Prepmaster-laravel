<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'student_id',
        'token'
    ];

    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
}
