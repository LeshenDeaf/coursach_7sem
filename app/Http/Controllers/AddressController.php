<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public const LIMIT = 5;
    private const API_KEY = "07fbd62b46521c158b3c90d24d167faaa1ecd205";
    private const ADDRESS = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address";

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
            CURLOPT_URL => 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address',
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
                'Authorization: Token ' . static::API_KEY,
                'Content-Type: application/json',
//                'Cookie: __ddg1=zkRk8yB8GOT6yg53NS2N'
            ],
        ]);


        $response = curl_exec($curl);

        if ($response === false) {
            return response()->json(['error' => curl_error($curl)], 500);
        }

        curl_close($curl);

        return $response;
    }
}
