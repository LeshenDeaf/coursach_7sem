<?php

namespace App\Http\Controllers\ESPlus;

use App\Http\Controllers\Controller;
use App\Http\Services\ESPlusService;
use App\Models\ESPlus\ESPlusToken;
use Illuminate\Http\Request;

class ESPlusTokenController extends Controller
{
    private ESPlusService $service;

    public function __construct()
    {
        $this->service = new ESPlusService();
    }

    public function index()
    {
        //
    }

    public function store(string $refreshToken)
    {
        return ESPlusToken::create([
            'user_id' => auth()->user()->id,
            'refresh_token' => $refreshToken
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login(Request $request)
    {
        $tokens = $this->service->login($request->input('login'), $request->input('password'));

        $this->store($tokens['refresh_token']);

        return $tokens;
    }

}
