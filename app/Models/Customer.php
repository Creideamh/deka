<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'surname',
        'firstname',
        'gender',
        'birthdate',
        'birthplace',
        'email',
        'form_of_identification',
        'id_number',
        'tin_umber',
        'marital_status',
        'occupation',
        'home_address',
        'postal_address',
        'phone_number',
        'customer_signature'
    ];

    public function application()
    {
        return $this->hasOne(application::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
