<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\PatientAppointment;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Procedure;
use App\Models\Specialist;
use App\Models\Room;
use App\Http\Requests\PatientAppointmentRequest;

class PatientAppointmentController extends Controller
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

        $patientAppointmentList = PatientAppointment::leftJoin(
            $patient_table,
            'patient_id',
            '=',
            $patient_table . '.id'
        )
            ->leftJoin($clinic_table, 'clinic_id', '=', $clinic_table . '.id')
            ->leftJoin(
                $procedure_table,
                'procedure_id',
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
                'anaethetist_id',
                '=',
                $specialist_table . '.id'
            )
            ->leftJoin($room_table, 'room_id', '=', $room_table . '.id')
            ->where('organization_id', auth()->user()->organization_id);

        $patientAppointments = [];

        if ($request->has('clinic_id')) {
            $patientAppointments = $patientAppointmentList
                ->where('clinic_id', $request->input('clinic_id'))
                ->get();
        } else {
            $patientAppointments = $patientAppointmentList->get();
        }

        return response()->json(
            [
                'message' => 'Patient Appointment List',
                'data' => $patientAppointments,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientAppointmentRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $room = Room::firstOrCreate([
            'name' => $request->name,
            'organization_id' => $organization_id,
            'clinc_id' => $request->clinc_id,
        ]);

        $patientAppointment = PatientAppointment::create([
            'patient_id' => $request->patient_id,
            'organization_id' => $organization_id,
            'clinic_id' => $request->clinic_id,
            'procedure_id' => $request->procedure_id,
            'primary_pathologist_id' => $request->input(
                'primary_pathologist_id',
                0
            ),
            'specialist_id' => $request->specialist_id,
            'anaethetist_id' => $request->anaethetist_id,
            'room_id' => $room->id,
            'reference_number' => $request->reference_number,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'actual_start_time' => $request->actual_start_time,
            'actual_end_time' => $request->actual_end_time,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Appointment created',
                'data' => $patientAppointment,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PatientAppointmentRequest  $request
     * @param  \App\Models\PatientAppointment  $patientAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientAppointmentRequest $request,
        PatientAppointment $patientAppointment
    ) {
        $organization_id = auth()->user()->organization_id;

        $room = Room::firstOrCreate([
            'name' => $request->name,
            'organization_id' => $organization_id,
            'clinc_id' => $request->clinc_id,
        ]);

        $patientAppointment->update([
            'patient_id' => $request->patient_id,
            'organization_id' => $organization_id,
            'clinic_id' => $request->clinic_id,
            'procedure_id' => $request->procedure_id,
            'primary_pathologist_id' => $request->input(
                'primary_pathologist_id',
                0
            ),
            'specialist_id' => $request->specialist_id,
            'anaethetist_id' => $request->anaethetist_id,
            'room_id' => $room->id,
            'reference_number' => $request->reference_number,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'actual_start_time' => $request->actual_start_time,
            'actual_end_time' => $request->actual_end_time,
        ]);

        return response()->json(
            [
                'message' => 'Patient Appointment updated',
                'data' => $patientAppointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientAppointment  $patientAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientAppointment $patientAppointment)
    {
        $patientAppointment->delete();

        return response()->json(
            [
                'message' => 'Patient Appointment Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
