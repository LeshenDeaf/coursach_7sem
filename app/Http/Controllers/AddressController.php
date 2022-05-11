<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public const LIMIT = 5;

    public const BOUND_TYPES = [
        'country' => 'Страна',
        'region' => 'Регион',
        'area' => 'Район',
        'city' => 'Город',
        'settlement' => 'Населенный пункт',
        'street' => 'Улица',
        'house' => 'Дом',
    ];

    public function getAddresses(Request $request)
    {
        if (!$request->input('query')) {
            return response()->json(['error' => "No address provided"], 400);
        }

        $curl = curl_init();

        if (!$curl) {
            response()->json(['error' => "Failed to init curl"], 500);
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => config('api.kladr.address.suggestion'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"query": "' . $request->input('query') . '", "count": ' . static::LIMIT . '}',
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Token ' . config('api.kladr.keys.api_key'),
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            return response()->json(['error' => curl_error($curl)], 500);
        }

        curl_close($curl);

        return $response;
    }

    public static function getAddressFromAPI(string $address)
    {
        $curl = curl_init();

        if (!$curl) {
            return false;
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => config('api.kladr.address.suggestion'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"query": "' . $address . '", "count": ' . static::LIMIT . '}',
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Token ' . config('api.kladr.keys.api_key'),
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            return ['error' => curl_error($curl)];
        }

        curl_close($curl);

        return $response;
    }

    public static function standardAddress(string $address)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('api.kladr.address.standard'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '["' . $address . '"]',
            CURLOPT_HTTPHEADER => [
                'Authorization: Token ' . config('api.kladr.keys.api_key'),
                'X-Secret: ' . config('api.kladr.keys.secret_key'),
                'Content-Type: application/json'
            ],
        ));

        return json_decode(curl_exec($curl), true)[0];
    }

    public static function isRealAddress($address): bool
    {
        return is_array($address)
            ? (bool)$address['result']
            : (bool)static::standardAddress($address)['result'];
    }

    public static function isFullAddress($address): bool
    {
        return is_array($address)
            ? $address['qc_complete'] === 0
            : static::standardAddress($address)['qc_complete'] === 0;
    }



}
