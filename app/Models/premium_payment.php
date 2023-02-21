<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premium_payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'premium_fee',
        'premium_savings',
        'premium_total',
        'premium_total',
        'premium_frequency',
        'premium_deduction',
        'premium_increase',
    ];


    public function premium_payers()
    {
        return $this->hasOne(premium_payer::class);
    }
}
