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
        $this->belongsToMany(
            User::class
        )->withTimestamps()->orderBy('id');
    }

    public static function getOrCreate($address): int
    {
        $address = Address::getReal(trim($address));

        if ($address === '') {
            return 0;
        }

        return Address::firstOrCreate(['address' => $address,])->id;
    }

    public static function getReal(string $rawAddress)
    {
        if (!$rawAddress) {
            return '';
        }

        $address = AddressController::standardAddress($rawAddress);

        if (AddressController::checkAddress($address)) {
            return $address['result'];
        }

        return '';
    }
}
