<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subscription_id',
        'start_date',
        'end_date',
        'status',
    ];
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
}

