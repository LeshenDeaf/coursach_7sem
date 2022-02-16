<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Field extends Model
{
    use HasFactory;

    public static array $types = [
        'price' => 1,
        'counter_value' => 2,
        'date' => 3,
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'label', 'type',
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
