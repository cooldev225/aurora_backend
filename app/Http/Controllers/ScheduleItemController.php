<?php

namespace App\Http\Controllers;

use App\Models\ScheduleItem;
use Illuminate\Http\Response;
use App\Http\Requests\ScheduleItemStoreRequest;
use App\Http\Requests\ScheduleItemUpdateRequest;

class ScheduleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', ScheduleItem::class);

        $organization_id = auth()->user()->organization_id;

        $schedule_items = ScheduleItem::where('organization_id', $organization_id)
                                      ->with('schedule_fees')
                                      ->get();

        return response()->json(
            [
                'message' => 'Schedule Item List',
                'data' => $schedule_items,
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
    public function store(ScheduleItemStoreRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', ScheduleItem::class);

        $scheduleItem = ScheduleItem::create([
            ...$request->validated(),
            'organization_id' => auth()->user()->organization_id,
        ]);

        return response()->json(
            [
                'message' => 'New Schedule Item created',
                'data' => $scheduleItem,
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
    public function update(ScheduleItemUpdateRequest $request, ScheduleItem $scheduleItem)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $scheduleItem);

        $scheduleItem->update($request->validated());

        return response()->json(
            [
                'message' => 'Schedule Item updated',
                'data' => $scheduleItem,
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
    public function destroy(ScheduleItem $scheduleItem)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $scheduleItem);

        $scheduleItem->delete();

        return response()->json(
            [
                'message' => 'Schedule Item Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
