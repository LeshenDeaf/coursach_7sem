<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id', 'answer', 'address_id'
    ];

    public function forms()
    {
        return $this->hasManyThrough(Form::class, Field::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Field::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
