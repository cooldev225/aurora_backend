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
        // Verify the user can access this function via policy
        $this->authorize('viewAny', HealthFund::class);

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
        // Verify the user can access this function via policy
        $this->authorize('create', HealthFund::class);

        $healthFund = HealthFund::create($request->validated());

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
        // Verify the user can access this function via policy
        $this->authorize('update', $healthFund);

        $healthFund->update($request->validated());

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
        // Verify the user can access this function via policy
        $this->authorize('delete', $healthFund);

        $healthFund->delete();

        return response()->json(
            [
                'message' => 'Health Fund Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
