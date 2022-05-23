<?php

namespace App\Http\Controllers\ESPlus;

use App\Http\Controllers\Controller;
use App\Http\Services\ESPlusService;
use App\Models\ESPlus\Accrual;
use App\Models\ESPlus\MainNumber;
use App\Models\ESPlus\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AccrualsController extends Controller
{
    private ESPlusService $service;

    public function __construct()
    {
        $this->service = new ESPlusService();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refresh(Request $request)
    {
        $authHeader = $request->headers->get('Authorization');

        if (!$authHeader || !($token = explode(' ', $authHeader)[1])) {
            return ['error' => 'You must authorize'];
        }

        $res = $this->service->accruals($token, $request->query());

        if (!$res || !$res['content']) {
            return response(['error' => 'Empty']);
        }

        $accruals = $res['content']['accruals'];

        $mainNumber = str_replace('KIESB|', '', $request->query('account_id'));

        $stored = [];

        foreach ($accruals as $accrual) {
            foreach ($accrual['services'] as $service) {
               $serviceId = Service::getOrCreate($service, (int)$mainNumber)->id;

                $stored[] = Accrual::create([
                   'accrued' => $service['accrued'],
                   'period' => Carbon::createFromFormat('m.Y', $accrual['period'])->toDateString(),
                   'service_id' => $serviceId,
                   'current_data' => $service['current_data']['t1'],
                   'consumption' => $service['consumption']['t1'],
               ]);
            }
        }

        return $stored;
    }
}
