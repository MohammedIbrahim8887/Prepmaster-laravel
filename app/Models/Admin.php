<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable =[
        'org_id',
        'name',
        'email',
        'password',
        'gender',
        'phoneNumber',
    ];


    public function organizations()
    {
        return $this->belongsTo(Organization::class,'org_id');
    }
    public function departments()
    {
        return $this->belongsTo(Department::class,'dept_id');
    }
    public function courses()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,'admin_role','admin_id','role_id');
    }

    // admin role relationship
    public function adminRoles()
    {
        return $this->hasMany(AdminRole::class, 'admin_id');
    }
}
