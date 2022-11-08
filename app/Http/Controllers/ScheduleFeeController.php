<?php

namespace App\Http\Controllers;

use App\Models\ScheduleFee;
use Illuminate\Http\Response;
use App\Http\Requests\ScheduleFeeStoreRequest;
use App\Http\Requests\ScheduleFeeUpdateRequest;

class ScheduleFeeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleFeeStoreRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', ScheduleFee::class);

        $scheduleFee = ScheduleFee::create($request->validated());

        return response()->json(
            [
                'message' => 'New Schedule Fee created',
                'data' => $scheduleFee,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleFeeUpdateRequest $request, ScheduleFee $scheduleFee)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $scheduleFee);

        $scheduleFee->update($request->validated());

        return response()->json(
            [
                'message' => 'Schedule Fee updated',
                'data' => $scheduleFee,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleFee $scheduleFee)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $scheduleFee);

        $scheduleFee->delete();

        return response()->json(
            [
                'message' => 'Schedule Fee Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
