<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Students extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $fillable = [
        'dept_id',
        'fullName',
        'email',
        'phoneNumber',
        'gender',
        'password',
    ];

    public function departments()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
    public function studentSubscriptions()
    {
        return $this->hasMany(StudentSubscription::class, 'student_id');
    }
    public function courses()
    {
        return $this->belongsTo(Course::class, 'dep_id');
    }
}
