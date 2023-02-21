<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class health_info extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'firstname',
        'illness_injury',
        'hospital',
        'duration',
        'present_condition'
    ];

    public function application()
    {
        return $this->hasOne(application::class);
    }
}
