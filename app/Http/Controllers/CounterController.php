<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CounterController extends Controller
{
    public const LIMIT = 20;

    public function search(Request $request)
    {
        list($registerType,  $factoryNumber) = [$request->input('register_type'), $request->input('factory_number')];
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

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('api.fgis.address.search')
                . '?fq=mi.mitnumber:*' . $this->addSlashes($registerType)
                . '*&fq=mi.number:*' . $this->addSlashes($factoryNumber)
                . '*&q=*&fl=' . implode(',', $fields)
                . '&sort=verification_date desc,org_title asc&rows=' . static::LIMIT
                . '&start=0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json, text/plain, */*',
//                'Cookie: session-cookie=16ee023b43d69554ae9509d918991a24fbe9d730fa952afe331bce3162108c224fbf49b99dafe6cf8fca84ed334f8be4'
            ),
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);
        return $response['response']['docs'];
    }

    private function addSlashes(string $str)
    {
        return str_replace('-', '\-', $str);
    }
}
