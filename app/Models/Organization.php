<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Organization extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable=[
        'name',
        'phoneNumber',
        'email',
        'password',
        'logo',
        'brandColor',
    ];


    public function admins()
    {
        return $this->hasMany(Admin::class, 'org_id');
    }
    public function organizationSubscriptions()
    {
        return $this->hasMany(OrganizationSubscription::class, 'org_id');
    }
}

