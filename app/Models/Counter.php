<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'vri_id',
        'registration_type_number',
        'modification_name',
        'factory_number',
        'release_year',
        'verification_date',
        'valid_until',
        'is_valid',
    ];

    protected $hidden = [];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function users()
    {
        return $this->address->users();
    }
}
