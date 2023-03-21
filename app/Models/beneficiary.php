<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'firstname',
        'beneficiary_gender',
        'beneficiary_date',
        'beneficiary_relationship',
        'benefit_percentage',
        'application_id'
    ];
}
