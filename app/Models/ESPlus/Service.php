<?php

namespace App\Models\ESPlus;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'main_number_id', 'es_id', 'name', 'code',
    ];

    public function accruals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Accrual::class);
    }

    public function mainNumber(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MainNumber::class);
    }

    public function address()
    {
        return $this->mainNumber->address;
    }

    public static function exist(int $esId): bool
    {
        $service = static::where('es_id', $esId)->first();

        return $service !== null && $service->exists();
    }

    public static function getOrCreate(array $service, int $kiesb)
    {
        if (!Service::exist((int)$service['id'])) {
            return Service::create([
                'main_number_id' => MainNumber::where('main_number', $kiesb)->first()->id,
                'es_id' => (int)$service['id'],
                'name' => $service['name'],
                'code' => $service['code'],
            ]);
        }

        return Service::where('es_id', (int)$service['id'])->first();
    }

}
