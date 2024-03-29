<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_number',
        'status',
        'customer_signature'
    ];

    public function health_info()
    {
        return $this->hasMany(health_info::class);
    }

    public function intermediaries()
    {
        return $this->hasMany(intermediary::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
