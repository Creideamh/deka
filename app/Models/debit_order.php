<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class debit_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'debit_order_firstname',
        'debit_order_surname',
        'bank_name',
        'bank_branch',
        'account_number',
        'account_type',
        'debit_order_signature'
    ];
}
