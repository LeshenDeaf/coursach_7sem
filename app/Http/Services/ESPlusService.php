<?php

namespace App\Http\Services;


use Illuminate\Http\Request;

class ESPlusService
{
    private \GuzzleHttp\Client $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => config('api.es_plus.addresses.base')
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login(string $login, string $password): array
    {
        if (auth()->user()->hasEsPlusToken()) {
            $response = json_decode($this->client->post(
                config('api.es_plus.addresses.refresh'),
                [
                    'json' => [
                        'refresh_token' => auth()->user()->esPlusToken->refresh_token,
                        'device_type' => 'web',
                        'type' => 'token',
                    ],
                ]
            )->getBody()->getContents(), true);
        } else {
            $response = json_decode($this->client->post(
                config('api.es_plus.addresses.login'),
                [
                    'json' => [
                        'login' => $login,
                        'password' => $password,
                        'branch_code' => 'kirov',
                        'device_type' => 'web',
                        'type' => 'login',
                    ]
                ]
            )->getBody()->getContents(), true);
        }

        if (!$response || !$response['content']) {
            return [];
        }

        return [
            'access_token' => $response['content']['access_token'],
            'refresh_token' => $response['content']['refresh_token'],
        ];
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function me(string $accessToken)
    {
        $response = $this->client->get(
            config('api.es_plus.addresses.me'),
            [
                'headers' => [
                    'Authorization' => "Bearer $accessToken"
                ]
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function accruals(string $accessToken, array $query)
    {
//        dd($query);
        $response = $this->client->get(
            config('api.es_plus.addresses.accruals'),
            [
                'headers' => ['Authorization' => "Bearer $accessToken"],
                'query' => $query,
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
