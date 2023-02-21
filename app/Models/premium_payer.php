<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premium_payer extends Model
{
    use HasFactory;

    public function premium_payments()
    {
        return $this->hasOne(premium_payment::class);
    }
}
