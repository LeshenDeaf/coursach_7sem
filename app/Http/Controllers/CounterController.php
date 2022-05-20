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

        curl_close($curl);

        if (!$response || !$response['response']['docs']) {
            return [];
        }

        return $response['response']['docs'];
    }

    public function findCounter(Request $request)
    {
        $request->validate([
            'address_id' => ['integer', 'required'],
            'register_type' => ['string', 'required'],
            'factory_number' => ['string', 'required'],
            'vri_id' => ['string', 'nullable']
        ]);


        if ($vri = $request->input('vri_id')) {
            $counter = $this->getFullInfo($vri);

            return [
                'counter' => $counter,
                'vri_id' => $vri,
                'applicability' => $counter && $counter['result'] && isset($counter['result']['vriInfo']['applicable']),
            ];
        }

        $docs = $this->search($request);

        if (!$docs) {
            return response()->json(['error' => 'No counters found'], 404);
        }

        if (count($docs) > 1) {
            $counters = array_column(Counter::whereIn('vri_id', array_column($docs, 'vri_id'))
                ->select('vri_id')->get()->toArray(), 'vri_id');

            $docs = [...array_filter($docs, fn ($doc) => !in_array($doc['vri_id'], $counters))];

            return ['error' => 'Too much counters found. Choose yours', 'counters' => $docs];
        }

        return [
            'counter' => $this->getFullInfo($docs[0]['vri_id']),
            'vri_id' => $docs[0]['vri_id'],
            'applicability' => $docs[0]['applicability']
        ];
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
            'vri_id' => ['string', 'nullable']
        ]);

        $counterData = $this->findCounter($request);

        if (isset($counterData['error']) && isset($counterData['counters'])) {
            return $counterData;
        }

        if ($counterData instanceof \Illuminate\Contracts\Foundation\Application
            || $counterData instanceof \Illuminate\Contracts\Routing\ResponseFactory
            || $counterData instanceof \Illuminate\Http\Response
        ) {
            return $counterData;
        }

        $counter = $counterData['counter'];

        if (!$counter || !$counter['result']) {
            return response()->json(['error' => 'Counter not found'], 404);
        }

        $miData = $counter['result']['miInfo']['singleMI'];
        $verificationData = $counter['result']['vriInfo'];

        return Counter::create([
            'address_id' => $request->input('address_id'),
            'vri_id' => $counterData['vri_id'],
            'registration_type_number' => $miData['mitypeNumber'],
            'modification_name' => $miData['modification'],
            'factory_number' => $miData['manufactureNum'],
            'release_year' => $miData['manufactureYear'] ?? 0,
            'verification_date' => $verificationData['vrfDate'],
            'valid_until' => $verificationData['validDate'],
            'is_valid' => $counterData['applicability'],
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
