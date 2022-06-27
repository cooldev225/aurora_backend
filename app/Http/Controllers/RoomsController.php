<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Rooms;
use App\Http\Requests\RoomsRequest;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  $clinc_id
     * @return \Illuminate\Http\Response
     */
    public function index($clinc_id)
    {
        $organization_id = auth()->user()->organization_id;

        $room = Room::where('organization_id', $organization_id)
            ->where('clinc_id', $clinc_id)
            ->get();

        return response()->json(
            [
                'message' => 'Room List',
                'data' => $room,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoomsRequest  $request
     * @param  $clinc_id
     * @return \Illuminate\Http\Response
     */
    public function store(RoomsRequest $request, $clinc_id)
    {
        $organization_id = auth()->user()->organization_id;

        $room = Room::create([
            'name' => $request->name,
            'organization_id' => $organization_id,
            'clinc_id' => $clinc_id,
        ]);

        return response()->json(
            [
                'message' => 'New Room created',
                'data' => $room,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoomsRequest  $request
     * @param  $clinc_id
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function update(RoomsRequest $request, $clinc_id, Rooms $rooms)
    {
        $organization_id = auth()->user()->organization_id;

        $room->update([
            'name' => $request->name,
            'organization_id' => $organization_id,
            'clinc_id' => $clinc_id,
        ]);

        return response()->json(
            [
                'message' => 'Room updated',
                'data' => $room,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $clinc_id
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function destroy($clinc_id, Rooms $rooms)
    {
        $room->delete();

        return response()->json(
            [
                'message' => 'Room Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
