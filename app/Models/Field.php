<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Field extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'label',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($question) {
            $question->name = Str::slug($question->label);
        });
    }

    public function forms()
    {
        return $this->belongsToMany(
            Form::class
        )->withTimestamps();
    }
}
