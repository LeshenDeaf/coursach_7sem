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

    public static array $typeLabels = [
        'Price' => 1,
        'Counter value' => 2,
        'Date' => 3,
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'label', 'type', 'user_id'
    ];

    protected static function boot() {
        parent::boot();

        static::creating(fn ($field) => $field->name = Str::slug($field->label));
    }

    public function forms()
    {
        return $this->belongsToMany(
            Form::class
        )->withTimestamps();
    }

    public static function getTypeLabel(int $type) {
        return array_flip(static::$typeLabels)[$type];
    }
}
