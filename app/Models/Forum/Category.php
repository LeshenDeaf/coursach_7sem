<?php

namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name',];

    protected static function boot() {
        parent::boot();

        static::creating(fn ($category) => $category->slug = Str::slug($category->name));
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
