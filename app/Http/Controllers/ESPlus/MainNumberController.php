<?php

namespace App\Http\Controllers\ESPlus;

use App\Http\Controllers\Controller;
use App\Http\Services\ESPlusService;
use App\Models\Address;
use App\Models\ESPlus\MainNumber;
use Illuminate\Http\Request;

class MainNumberController extends Controller
{
    private ESPlusService $service;

    public function __construct()
    {
        $this->service = new ESPlusService();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function me(Request $request)
    {
        $authHeader = $request->headers->get('Authorization');

        if (!$authHeader || !($token = explode(' ', $authHeader)[1])) {
//            if (auth()->user()->hasEsPlusToken()) {
//                $refreshToken = auth()->user()->esPlusToken;
//            }
            return ['error' => 'You must authorize'];
        }

        $res = $this->service->me($token)['content'];

        $addresses = array_column($res['objects'], 'address');

        $mainNumber = $res['main_number'];

        foreach ($addresses as $address) {
            $address = Address::getOrCreate($address);

            if (MainNumber::where('address_id', $address)
                ->where('main_number', $mainNumber)
                ->exists()
            ) {
                continue;
            }

            MainNumber::create([
                'address_id' => $address,
                'main_number' => $mainNumber
            ]);
        }

        return compact('mainNumber');
    }
}
