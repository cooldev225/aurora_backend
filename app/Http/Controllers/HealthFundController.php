<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\HealthFund;
use App\Http\Requests\HealthFundRequest;

class HealthFundController extends Controller
{
    /**
     * [Health Fund] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $healthFund = HealthFund::all();

        return response()->json(
            [
                'message' => 'Health Fund List',
                'data' => $healthFund,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Health Fund] - Store
     *
     * @param  \App\Http\Requests\HealthFundRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HealthFundRequest $request)
    {
        $healthFund = HealthFund::create([
            'name' => $request->name,
            'code' => $request->code,
            'fund' => $request->fund,
            'contact' => $request->contact,
            'issues' => $request->issues,
        ]);

        return response()->json(
            [
                'message' => 'New Health Fund created',
                'data' => $healthFund,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Health Fund] - Update
     *
     * @param  \App\Http\Requests\HealthFundRequest  $request
     * @param  \App\Models\HealthFund  $healthFund
     * @return \Illuminate\Http\Response
     */
    public function update(HealthFundRequest $request, HealthFund $healthFund)
    {
        $healthFund->update([
            'name' => $request->name,
            'code' => $request->code,
            'fund' => $request->fund,
            'contact' => $request->contact,
            'issues' => $request->issues,
        ]);

        return response()->json(
            [
                'message' => 'Health Fund updated',
                'data' => $healthFund,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Health Fund] - Destroy
     *
     * @param  \App\Models\HealthFund  $healthFund
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthFund $healthFund)
    {
        $healthFund->delete();

        return response()->json(
            [
                'message' => 'Health Fund Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
