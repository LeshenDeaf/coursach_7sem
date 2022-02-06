<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'fields'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fields()
    {
        return $this->belongsToMany(
            Field::class
        )->withTimestamps();
    }
}
