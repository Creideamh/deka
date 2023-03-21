<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trustee extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'firstname',
        'trustee_gender',
        'trustee_birthdate',
        'trustee_relationship',
        'trustee_address',
        'trustee_contact',
        'application_id'
    ];
}
