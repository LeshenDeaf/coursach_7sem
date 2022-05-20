<?php

namespace App\Models;

use App\Models\ESPlus\ESPlusToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'roles', 'addresses',];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Role::class
        )->withTimestamps()->orderBy('id');
    }

    public function forms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Form::class)->orderBy('id')->orderBy('id');
    }

    public function fields()
    {
        return $this->hasMany(Field::class)->orderBy('id')->orderBy('id');
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Field::class)->orderBy('id');
    }

    public function addresses(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Address::class
        )->withTimestamps()->orderBy('id');
    }

    public function esPlusToken(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ESPlusToken::class);
    }

    public function hasEsPlusToken(): bool
    {
        return $this->esPlusToken()->exists();
    }

    public function isAdmin(): bool
    {
        return $this->roles()
            ->where('id', Role::ADMIN)
            ->exists();
    }

    public function isUK(): bool
    {
        return $this->roles()
            ->where('id', Role::UK_USER)
            ->exists();
    }

    public function isLiveIn(string $address): bool
    {
        return $this->addresses()
            ->where('address', $address)
            ->exists();
    }
}
