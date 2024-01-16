<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationSession extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "org_id",
        'token'
    ];

    public function organizations()
    {
        return $this->belongsTo(Organization::class, "org_id");
    }
}
