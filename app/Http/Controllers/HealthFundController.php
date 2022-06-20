<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\HealthFund;
use App\Http\Requests\HealthFundRequest;

class HealthFundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $healthFund = HealthFund::all()->toArray();

        return response()->json(
            [
                'message' => 'Health Fund List',
                'data' => $healthFund,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HealthFundRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HealthFundRequest $request)
    {
        $healthFund = HealthFund::create([
            'name' => $request->name,
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HealthFundRequest  $request
     * @param  \App\Models\HealthFund  $healthFund
     * @return \Illuminate\Http\Response
     */
    public function update(HealthFundRequest $request, HealthFund $healthFund)
    {
        $healthFund->update([
            'name' => $request->name,
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
     * Remove the specified resource from storage.
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
