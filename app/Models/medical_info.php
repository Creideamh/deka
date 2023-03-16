<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medical_info extends Model
{
    use HasFactory;

    protected $fillable = [
        'existing_policy',
        'existing_policy_number',
        'life_insurance_status',
        'medical_health_status',
        'refusal_reasons',
        'application_id'
    ];
}
