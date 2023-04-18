<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premium_payer extends Model
{
    use HasFactory;

    protected $fillable = [
        'premium_title',
        'premium_surname',
        'premium_firstname',
        'premium_birthdate',
        'premium_mobile_number',
        'premium_email',
        'premium_tin',
    ];

    public function premium_payments()
    {
        return $this->hasOne(premium_payment::class);
    }
}
