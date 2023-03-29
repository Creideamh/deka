<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intermediary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subagent_code',
        'signature',
        'date_to_deduction'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
