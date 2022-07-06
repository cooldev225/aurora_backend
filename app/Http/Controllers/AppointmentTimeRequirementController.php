<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\AppointmentTimeRequirement;
use App\Http\Requests\AppointmentTimeRequirementRequest;

class AppointmentTimeRequirementController extends BaseOrganizationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentTimeRequirementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentTimeRequirementRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $appointmentTimeRequirement = AppointmentTimeRequirement::create([
            'organization_id' => $organization_id,
            'base_time' => date('H:i:s', strtotime($request->base_time)),
            ...$request->all(),
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentTimeRequirementRequest  $request
     * @param  \App\Models\AppointmentTimeRequirement  $appointmentTimeRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentTimeRequirementRequest $request,
        AppointmentTimeRequirement $appointmentTimeRequirement
    ) {
        $organization_id = auth()->user()->organization_id;

        if ($appointmentTimeRequirement->organization_id != $organization_id) {
            return $this->forbiddenOrganization();
        }

        $appointmentTimeRequirement->update([
            'organization_id' => $organization_id,
            'base_time' => date('H:i:s', strtotime($request->base_time)),
            ...$request->all(),
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentTimeRequirement  $appointmentTimeRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        AppointmentTimeRequirement $appointmentTimeRequirement
    ) {
        $appointmentTimeRequirement->delete();

        return response()->json(
            [
                'message' => 'Appointment Time Requirement Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
