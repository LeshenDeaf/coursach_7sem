<?php

namespace App\Models\Forum;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'user_id',
        'title', 'text', 'address_id'
    ];

    protected static function boot() {
        parent::boot();

        static::creating(fn ($thread) => $thread->slug = Str::slug($thread->title));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(ThreadComment::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
