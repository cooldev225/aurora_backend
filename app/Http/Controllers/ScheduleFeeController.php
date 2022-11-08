<?php

namespace App\Http\Controllers;

use App\Models\ScheduleFee;
use Illuminate\Http\Response;
use App\Http\Requests\ScheduleFeeStoreRequest;
use App\Http\Requests\ScheduleFeeUpdateRequest;

class ScheduleFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', ScheduleFee::class);

        $organization_id = auth()->user()->organization_id;

        $schedule_fees = ScheduleFee::where('organization_id', $organization_id)->get();

        return response()->json(
            [
                'message' => 'Schedule Fee List',
                'data' => $schedule_fees,
            ],
            Response::HTTP_OK
        );
    }

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
        $scheduleFee = null;
        $organization_id = auth()->user()->organization_id;
        $schedule_fees = ScheduleFee::where('organization_id', $organization_id)
                        ->where("mbs_item_code", $request->mbs_item_code)
                        ->where("health_fund_code", $request->health_fund_code);
        if($schedule_fees->count()){
            $scheduleFee = $schedule_fees->first();
            $scheduleFee = $scheduleFee->update($request->validated());
        }else{

            $scheduleFee = ScheduleFee::create([
                ...$request->validated(),
                'organization_id' => auth()->user()->organization_id,
            ]);
        }

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
    public function destroy(string $mbs_item_code)
    {
        $organization_id = auth()->user()->organization_id;
        $schedule_fees = ScheduleFee::where('organization_id', $organization_id)
                        ->where("mbs_item_code", $mbs_item_code);

        if($schedule_fees->count()){
            // Verify the user can access this function via policy
            $this->authorize('delete', $schedule_fees->first());

            foreach(ScheduleFee::where('organization_id', $organization_id)
                                ->where("mbs_item_code", $mbs_item_code)
                                ->get() as $scheduleFee){
                $scheduleFee->delete();
            }
        }
        
        return response()->json(
            [
                'message' => 'Schedule Fee Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
