<?php

namespace App\Models\ESPlus;

use Illuminate\Database\Eloquent\Model;

class Accrual extends Model
{
    protected $fillable = [
        'service_id', 'period', 'current_data', 'accrued', 'consumption'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
