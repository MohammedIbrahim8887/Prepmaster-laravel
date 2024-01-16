<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'admin_id',
    ];

    public function students()
    {
        return $this->hasOne(Students::class, 'dept_id');
    }
    public function admins()
    {
        return $this->hasMany(Admin::class , 'admin_id');
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'dept_id');
    }

}

