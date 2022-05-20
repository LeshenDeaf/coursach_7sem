<?php

namespace App\Models\ESPlus;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ESPlusToken extends Model
{
    protected $fillable = [
        'user_id', 'refresh_token'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
