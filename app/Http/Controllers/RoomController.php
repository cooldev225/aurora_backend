<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Room;
use App\Http\Requests\RoomRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  $clinic_id
     * @return \Illuminate\Http\Response
     */
    public function index($clinic_id)
    {
        $organization_id = auth()->user()->organization_id;

        $room = Room::where('organization_id', $organization_id)
            ->where('clinic_id', $clinic_id)
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
     * @param  \App\Http\Requests\RoomRequest  $request
     * @param  $clinic_id
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request, $clinic_id)
    {
        $organization_id = auth()->user()->organization_id;

        $room = Room::create([
            'name' => $request->name,
            'organization_id' => $organization_id,
            'clinic_id' => $clinic_id,
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
     * @param  \App\Http\Requests\RoomRequest  $request
     * @param  $clinic_id
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $clinic_id, Room $room)
    {
        $organization_id = auth()->user()->organization_id;

        $room->update([
            'name' => $request->name,
            'organization_id' => $organization_id,
            'clinic_id' => $clinic_id,
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
     * @param  $clinic_id
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($clinic_id, Room $room)
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