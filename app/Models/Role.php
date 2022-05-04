<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const ADMIN = 1;
    public const NORMAL_USER = 2;
    public const UK_USER = 3;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            User::class
        )->withTimestamps()->orderBy('id');
    }
}
