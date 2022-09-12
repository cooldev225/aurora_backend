<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\AppointmentTimeRequirement;
use App\Http\Requests\AppointmentTimeRequirementRequest;
use Carbon\Carbon;

class AppointmentTimeRequirementController extends Controller
{
    /**
     * [Appointment Time Requirement] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', AppointmentTimeRequirement::class);

        $organization_id = auth()->user()->organization_id;

        $appointmentTimeRequirement = AppointmentTimeRequirement::where(
            'organization_id',
            $organization_id
        )->get();

        return response()->json(
            [
                'message' => 'Appointment Time Requirement List',
                'data' => $appointmentTimeRequirement,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Appointment Time Requirement] - Store
     *
     * @param  \App\Http\Requests\AppointmentTimeRequirementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentTimeRequirementRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', AppointmentTimeRequirement::class);

        $organization_id = auth()->user()->organization_id;

        $appointmentTimeRequirement = AppointmentTimeRequirement::create([
            'title'           => $request->title,
            'organization_id' => $organization_id,
            'base_time'       => Carbon::create($request->base_time)->toTimeString(),
        ]);

        return response()->json(
            [
                'message' => 'New Appointment Time Requirement created',
                'data' => $appointmentTimeRequirement,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Appointment Time Requirement] - Update
     *
     * @param  \App\Http\Requests\AppointmentTimeRequirementRequest  $request
     * @param  \App\Models\AppointmentTimeRequirement  $appointmentTimeRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentTimeRequirementRequest $request,
        AppointmentTimeRequirement $appointmentTimeRequirement
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $appointmentTimeRequirement);

        $organization_id = auth()->user()->organization_id;

        $appointmentTimeRequirement->update([
            'title'           => $request->title,
            'organization_id' => $organization_id,
            'base_time'       => Carbon::create($request->base_time)->toTimeString(),
        ]);

        return response()->json(
            [
                'message' => 'Appointment Time Requirement updated',
                'data' => $appointmentTimeRequirement,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Appointment Time Requirement] - Destroy
     *
     * @param  \App\Models\AppointmentTimeRequirement  $appointmentTimeRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        AppointmentTimeRequirement $appointmentTimeRequirement
    ) {
        // Verify the user can access this function via policy
        $this->authorize('delete', $appointmentTimeRequirement);

        $appointmentTimeRequirement->delete();

        return response()->json(
            [
                'message' => 'Appointment Time Requirement Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
