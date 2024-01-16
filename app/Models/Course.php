<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'admin_id',
        'dept_id',
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'admin_id');
    }
    public function departments()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
    public function questions()
    {
        return $this->hasMany(Questions::class , 'course_id');
    }
}
