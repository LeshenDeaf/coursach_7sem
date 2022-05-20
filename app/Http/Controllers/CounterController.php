<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public const LIMIT = 20;

    public function search(Request $request)
    {
        $curl = curl_init();

        $fields = [
            'vri_id',
            'mi.mitnumber',
            'mi.modification',
            'mi.number',
            'verification_date',
            'valid_date',
            'applicability',
            'sticker_num'
        ];

        curl_setopt_array(
            $curl,
            $this->makeCurlArray(
                config('api.fgis.address.search')
                . '?fq=mi.mitnumber:' . urlencode($request->input('register_type'))
                . '&fq=mi.number:' . urlencode($request->input('factory_number'))
                . '&q=*&fl=' . implode(',', $fields)
                . '&sort=verification_date%20desc,org_title%20asc&rows=' . static::LIMIT
                . '&start=0'
            )
        );

        $response = json_decode(curl_exec($curl), true);

        if (!$response || !$response['response']['docs']) {
            return [];
        }

        curl_close($curl);
        return $response['response']['docs'];
    }

    public function getFullInfo(string $vriId)
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            $this->makeCurlArray(config('api.fgis.address.get') . $vriId)
        );

        $response = json_decode(curl_exec($curl), true);

        if (!$response) {
            return [];
        }

        curl_close($curl);
        return $response;
    }

    public function store(Request $request)
    {
        //        $request->input('register_type'), $request->input('factory_number');
        $request->validate([
            'address_id' => ['integer', 'required'],
            'register_type' => ['string', 'required'],
            'factory_number' => ['string', 'required'],
        ]);

        $docs = $this->search($request);

        if (!$docs) {
            return response()->json(['error' => 'No counters found'], 404);
        }

        $counter = $this->getFullInfo($docs[0]['vri_id']);

        if (!$counter || !$counter['result']) {
            return response()->json(['error' => 'Counter not found'], 404);
        }

        $miData = $counter['result']['miInfo']['singleMI'];
        $verificationData = $counter['result']['vriInfo'];

        return Counter::create([
            'address_id' => $request->input('address_id'),
            'vri_id' => $docs[0]['vri_id'],
            'registration_type_number' => $miData['mitypeNumber'],
            'modification_name' => $miData['modification'],
            'factory_number' => $miData['manufactureNum'],
            'release_year' => $miData['manufactureYear'] ?? 0,
            'verification_date' => $verificationData['vrfDate'],
            'valid_until' => $verificationData['validDate'],
            'is_valid' => $docs[0]['applicability'],
        ]);
    }

    private function addSlashes(string $str)
    {
        return str_replace('-', '%5C-', $str);
    }

    private function makeCurlArray(string $url, string $method = 'GET'): array
    {
        return [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json, text/plain, */*',
            ],
        ];
    }
}
