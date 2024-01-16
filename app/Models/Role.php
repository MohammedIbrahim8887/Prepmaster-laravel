<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_id',
        'name',
    ];

    public function adminRoles()
    {
        return $this->hasMany(AdminRole::class, 'role_id');
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_id');
    }

}
