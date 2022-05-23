<?php

namespace App\Models\ESPlus;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class MainNumber extends Model
{
    protected $table = 'main_number';

    protected $fillable = [
        'address_id', 'main_number'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
