<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\AppointmentType;
use App\Http\Requests\AppointmentTypeRequest;

class AppointmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $organization_id = auth()->user()->organization_id;

        $appointmentTypes = AppointmentType::where(
            'organization_id',
            $organization_id
        );

        if ($request->has('status')) {
            $appointmentTypes->where('status', $request->status);
        }

        $appointmentTypes = $appointmentTypes->get();

        return response()->json(
            [
                'message' => 'Appointment Type List',
                'data' => $appointmentTypes,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentTypeRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $appointmentType = AppointmentType::create([
            'organization_id' => $organization_id,
            'type' => $request->type,
            'color' => $request->color,
            'mbs_code' => $request->mbs_code,
            'mbs_description' => $request->mbs_description,
            'clinical_code' => $request->clinical_code,
            'name' => $request->name,
            'invoice_by' => $request->invoice_by,
            'arrival_time' => $request->arrival_time,
            'appointment_time' => $request->appointment_time,
            'payment_tier_1' => $request->payment_tier_1,
            'payment_tier_2' => $request->payment_tier_2,
            'payment_tier_3' => $request->payment_tier_3,
            'payment_tier_4' => $request->payment_tier_4,
            'payment_tier_5' => $request->payment_tier_5,
            'payment_tier_6' => $request->payment_tier_6,
            'payment_tier_7' => $request->payment_tier_7,
            'payment_tier_8' => $request->payment_tier_8,
            'payment_tier_9' => $request->payment_tier_9,
            'payment_tier_10' => $request->payment_tier_10,
            'payment_tier_11' => $request->payment_tier_11,
            'anesthetist_required' => $request->anesthetist_required,
            'status' => $request->status,
        ]);

        return response()->json(
            [
                'message' => 'New Appointment Type created',
                'data' => $appointmentType,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentTypeRequest  $request
     * @param  \App\Models\AppointmentType  $appointmentType
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentTypeRequest $request,
        AppointmentType $appointmentType
    ) {
        $organization_id = auth()->user()->organization_id;

        $appointmentType->update([
            'organization_id' => $organization_id,
            'type' => $request->type,
            'color' => $request->color,
            'mbs_code' => $request->mbs_code,
            'mbs_description' => $request->mbs_description,
            'clinical_code' => $request->clinical_code,
            'name' => $request->name,
            'invoice_by' => $request->invoice_by,
            'arrival_time' => $request->arrival_time,
            'appointment_time' => $request->appointment_time,
            'payment_tier_1' => $request->payment_tier_1,
            'payment_tier_2' => $request->payment_tier_2,
            'payment_tier_3' => $request->payment_tier_3,
            'payment_tier_4' => $request->payment_tier_4,
            'payment_tier_5' => $request->payment_tier_5,
            'payment_tier_6' => $request->payment_tier_6,
            'payment_tier_7' => $request->payment_tier_7,
            'payment_tier_8' => $request->payment_tier_8,
            'payment_tier_9' => $request->payment_tier_9,
            'payment_tier_10' => $request->payment_tier_10,
            'payment_tier_11' => $request->payment_tier_11,
            'anesthetist_required' => $request->anesthetist_required,
            'status' => $request->status,
        ]);

        return response()->json(
            [
                'message' => 'Appointment Type updated',
                'data' => $appointmentType,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentType  $appointmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentType $appointmentType)
    {
        $appointmentType->delete();

        return response()->json(
            [
                'message' => 'Appointment Type Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
