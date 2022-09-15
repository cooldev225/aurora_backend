<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Clinic;
use Illuminate\Http\Response;
use App\Http\Requests\RoomRequest;

class RoomController extends Controller
{
    /**
     * [Room] - List
     *
     * @param  $clinic_id
     * @return \Illuminate\Http\Response
     */
    public function index(Clinic $clinic)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Room::class);

        $organization_id = auth()->user()->organization_id;

        $room = Room::where('organization_id', $organization_id)
            ->where('clinic_id', $clinic->id)
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
     * [Room] - Store
     *
     * @param  \App\Http\Requests\RoomRequest  $request
     * @param  $clinic_id
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request, Clinic $clinic)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', Room::class);

        $room = Room::create([
            ...$request->validated(),
            'organization_id' => auth()->user()->organization_id,
            'clinic_id' => $clinic->id,
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
     * [Room] - Update
     *
     * @param  \App\Http\Requests\RoomRequest  $request
     * @param  $clinic_id
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, Clinic $clinic, Room $room)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $room);

        $room->update($request->validated());

        return response()->json(
            [
                'message' => 'Room updated',
                'data' => $room,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Room] - Destroy
     *
     * @param  $clinic_id
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Room $room)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $room);

        $room->delete();

        return response()->json(
            [
                'message' => 'Room Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
