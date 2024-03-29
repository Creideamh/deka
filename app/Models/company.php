<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     * a company has many branches
     */
    public function branches()
    {
        return $this->hasMany(branch::class, 'company_id');
    }
}
