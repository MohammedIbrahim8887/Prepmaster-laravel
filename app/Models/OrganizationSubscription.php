<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationSubscription extends Model
{
    use HasFactory;

    protected $fillable=[
        'org_id',
        'subscription_id',
        'start_date',
        'end_date',
        'status',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }
}
