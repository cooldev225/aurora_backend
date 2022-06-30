<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Procedure;
use App\Models\Specialist;
use App\Models\Room;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient_table = (new Pati◘ent())->getTable();
        $clinic_table = (new Clinic())->getTable();
        $procedure_table = (new Procedure())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $room_table = (new Room())->getTable();

        $appointmentList = Appointment::leftJoin(
            $patient_table,
            'patient_id',
            '=',
            $patient_table . '.id'
        )
            ->leftJoin($clinic_table, 'clinic_id', '=', $clinic_table . '.id')
            ->leftJoin(
                $procedure_table,
                'appointment_type_id',
                '=',
                $procedure_table . '.id'
            )
            ->leftJoin(
                $specialist_table,
                'primary_pathologist_id',
                '=',
                $specialist_table . '.id'
            )
            ->leftJoin(
                $specialist_table,
                'specialist_id',
                '=',
                $specialist_table . '.id'
            )
            ->leftJoin(
                $specialist_table,
                'anesthetist_id',
                '=',
                $specialist_table . '.id'
            )
            ->leftJoin($room_table, 'room_id', '=', $room_table . '.id')
            ->where('organization_id', auth()->user()->organization_id);

        $appointments = [];

        if ($request->has('clinic_id')) {
            $appointments = $appointmentList
                ->where('clinic_id', $request->input('clinic_id'))
                ->get();
        } else {
            $appointments = $appointmentList->get();
        }

        return response()->json(
            [
                'message' => 'Appointment List',
                'data' => $appointments,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'organization_id' => $organization_id,
            'clinic_id' => $request->clinic_id,
            'appointment_type_id' => $request->appointment_type_id,
            'primary_pathologist_id' => $request->input(
                'primary_pathologist_id',
                0
            ),
            'specialist_id' => $request->specialist_id,
            'anesthetist_id' => $request->anesthetist_id,
            'room_id' => $request->room_id,
            'reference_number' => $request->reference_number,
            'date' => $request->date,
            'arrival_time' => $request->arrival_time,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'actual_arrival_time' => $request->actual_arrival_time,
            'actual_start_time' => $request->actual_start_time,
            'actual_end_time' => $request->actual_end_time,
            'charge_type' => $request->charge_type,
            'is_waitlisted' => $request->is_waitlisted,
        ]);

        return response()->json(
            [
                'message' => 'New Appointment created',
                'data' => $appointment,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentRequest $request,
        Appointment $appointment
    ) {
        $organization_id = auth()->user()->organization_id;

        $appointment->update([
            'patient_id' => $request->patient_id,
            'organization_id' => $organization_id,
            'clinic_id' => $request->clinic_id,
            'appointment_type_id' => $request->appointment_type_id,
            'primary_pathologist_id' => $request->input(
                'primary_pathologist_id',
                0
            ),
            'specialist_id' => $request->specialist_id,
            'anesthetist_id' => $request->anesthetist_id,
            'room_id' => $request->room_id,
            'reference_number' => $request->reference_number,
            'date' => $request->date,
            'arrival_time' => $request->arrival_time,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'actual_arrival_time' => $request->actual_arrival_time,
            'actual_start_time' => $request->actual_start_time,
            'actual_end_time' => $request->actual_end_time,
            'charge_type' => $request->charge_type,
            'is_waitlisted' => $request->is_waitlisted,
        ]);

        return response()->json(
            [
                'message' => 'Appointment updated',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json(
            [
                'message' => 'Appointment Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
