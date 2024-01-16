<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'role_id',
    ];

    // admin relationship
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // role relationship
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
