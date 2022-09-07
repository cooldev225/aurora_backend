<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Room;
use App\Http\Requests\RoomRequest;

class RoomController extends Controller
{
    /**
     * [Room] - List
     *
     * @param  $clinic_id
     * @return \Illuminate\Http\Response
     */
    public function index($clinic_id)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAll', Room::class);

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
     * [Room] - Store
     *
     * @param  \App\Http\Requests\RoomRequest  $request
     * @param  $clinic_id
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request, $clinic_id)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', Room::class);

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
     * [Room] - Update
     *
     * @param  \App\Http\Requests\RoomRequest  $request
     * @param  $clinic_id
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $clinic_id, Room $room)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $room);

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
     * [Room] - Destroy
     *
     * @param  $clinic_id
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($clinic_id, Room $room)
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
