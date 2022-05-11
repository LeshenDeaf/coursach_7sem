<?php

namespace App\Models;

use App\Http\Controllers\AddressController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address'
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class
        )->withTimestamps()->orderBy('id');
    }

    public static function getOrCreateFull($address): int
    {
        $address = Address::getStandardizedFull(trim($address));

        if ($address === '') {
            return 0;
        }

        return Address::firstOrCreate(['address' => $address,])->id;
    }

    public static function getOrCreate($address): int
    {
        $address = Address::getStandardized(trim($address));

        if ($address === '') {
            return 0;
        }

        return Address::firstOrCreate(['address' => $address,])->id;
    }

    public static function getStandardizedFull(string $rawAddress)
    {
        if (!$rawAddress) {
            return '';
        }

        $address = AddressController::standardAddress($rawAddress);

        if (AddressController::isFullAddress($address)) {
            return $address['result'];
        }

        return '';
    }

    public static function getStandardized(string $rawAddress)
    {
        if (!$rawAddress) {
            return '';
        }

        $address = AddressController::standardAddress($rawAddress);

        if (AddressController::isRealAddress($address)) {
            return $address['result'];
        }

        return '';
    }
}
