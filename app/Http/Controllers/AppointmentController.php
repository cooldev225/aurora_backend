<?php

namespace App\Http\Controllers;

use App\Enum\ConfirmationStatus;
use App\Enum\UserRole;
use App\Http\Requests\AppointmentCreateRequest;
use App\Http\Requests\AppointmentIndexRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Models\AppointmentType;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentCodes;
use App\Models\Patient;
use App\Models\PatientBilling;
use App\Models\AppointmentPreAdmission;
use App\Models\AppointmentReferral;
use App\Models\Organization;
use App\Models\PatientAlsoKnownAs;
use App\Models\User;
use App\Notifications\AppointmentNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AppointmentIndexRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Appointment::class);
    
        $appointments = Appointment::
        where('organization_id', auth()->user()->organization_id)
            ->wherenot('confirmation_status', ConfirmationStatus::CANCELED)
            ->with('appointment_type')
            ->with('referral')
            ->with('anesthetist')
            ->with('specialist.scheduleTimeslots.anesthetist')
            ->orderBy('date')
            ->orderBy('start_time');

        $params = $request->validated();
        foreach ($params as $column => $param) {

            if ($column == 'date') {
                $param = Carbon::parse($param)->format('Y-m-d');
                $day = strtoupper(Carbon::parse($param)->format('D'));
                $appointments = $appointments->with(['specialist.scheduleTimeslots' => function ($query) use ($day) {
                    $query->where('week_day', $day);
                }
                ]);
            } else {
                $appointments = $appointments->where($column, '=', $param);
            }
        }
        if ($request->has('date')) {
            $date = Carbon::create($request->date)->toDateString();
            $day = Carbon::create($request->date)->dayOfWeek;
        }

        return response()->json(
            [
                'message' => 'Appointments',
                'data' => $appointments->get(),
            ],
            Response::HTTP_OK
        );
    }


    public function show(Appointment $appointment)
    {
        // Verify the user can access this function via policy
        $this->authorize('view', $appointment);

        return response()->json(
            [
                'message' => 'Appointment List',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\AppointmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentCreateRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', Appointment::class);
        $this->authorize('create', AppointmentReferral::class);
        $this->authorize('create', AppointmentPreAdmission::class);

        $patient = Patient::find($request->patient_id);
        if ($patient) {
            // Verify the user can access this function via policy
            $this->authorize('update', $patient);
            $this->authorize('update', $patient->billing->first());

            $patient->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => Carbon::create($request->date_of_birth)->toDateString(),
                'contact_number' => $request->contact_number,
                'address' => $request->address,
                'email' => $request->email,
                'appointment_confirm_method' => $request->appointment_confirm_method,
                'allergies' => $request->allergies,
                'clinical_alerts' => $request->clinical_alerts,
            ]);
        } else {
            // Verify the user can access this function via policy
            $this->authorize('create', Patient::class);
            $this->authorize('create', PatientBilling::class);

            $patient = Patient::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => Carbon::create($request->date_of_birth)->toDateString(),
                'contact_number' => $request->contact_number,
                'address' => $request->address,
                'email' => $request->email,
                'appointment_confirm_method' => $request->appointment_confirm_method,
                'allergies' => $request->allergies,
                'clinical_alerts' => $request->clinical_alerts,
            ]);

            $patient->organizations()->attach(Organization::find(auth()->user()->organization_id));
        }

        foreach ($request->claim_sources as $claim_source) {
            PatientBilling::create([
                'is_valid' => true,
                'verified_at' => now(),
                'patient_id' => $patient->id,
                ...$claim_source,
            ]);
        }

        foreach ($request->also_known_as as $known_as) {
            PatientAlsoKnownAs::create([
                'patient_id'  => $patient->id,
                ...$known_as,
            ]);
        }

        $startTime = Carbon::create($request->start_time);

        $appointment = Appointment::create([
            'date' => Carbon::create($request->date)->toDateString(),
            'arrival_time' => $request->arrival_time,
            'start_time' => $request->start_time,
            'end_time' => $this->aptEndTime($request)->toTimeString(),
            'patient_id' => $patient->id,
            'organization_id' => auth()->user()->organization_id,
            'appointment_type_id' => $request->appointment_type_id,
            'clinic_id' => $request->clinic_id,
            'specialist_id' => $request->specialist_id,
            'anesthetist_id' => User::find($request->specialist_id)->hrmUserBaseSchedulesTimeDay($startTime->timestamp, strtoupper(Carbon::parse($request->date)->format('D')))?->anesthetist_id,
            'note' => $request->note,
            'charge_type' => $request->charge_type,
            'room_id' => $request->room_id,
        ]);

        AppointmentCodes::create([
            'appointment_id' => $appointment->id
        ]);

        AppointmentReferral::create([
            'appointment_id' => $appointment->id,
            'referring_doctor_id' => $request->referring_doctor_id,
            'referral_date' => Carbon::create($request->referral_date)->toDateString(),
            'referral_duration' => $request->referral_duration,
            'is_no_referral' => false,
        ]);

        AppointmentPreAdmission::create([
            'appointment_id' => $appointment->id,
            'token' => md5($appointment->id)
        ]);

        AppointmentNotification::send($appointment, 'appointment_booked');

        return response()->json(
            [
                'message' => 'New Appointment created',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\AppointmentRequest $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentUpdateRequest $request, Appointment $appointment)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $appointment);
        $this->authorize('update', $appointment->patient);
//        $this->authorize('update', $appointment->patient->billing->first());
        $this->authorize('update', $appointment->referral->first());

        $appointment->update([
            'appointment_type_id' => $request->appointment_type_id,
            'room_id' => $request->room_id,
            'note' => $request->note,
            'charge_type' => $request->charge_type,
            'end_time' => $this->aptEndTime($request)->toTimeString(),
        ]);

        $appointment->patient()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => Carbon::create($request->date_of_birth)->toDateString(),
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'email' => $request->email,
            'appointment_confirm_method' => $request->appointment_confirm_method,
            'clinical_alerts' => $request->clinical_alerts,
        ]);

        //return ($appointment);
        $patient = Patient::find($request->patient_id);

        foreach ($request->claim_sources as $claim_source) {
            PatientBilling::create([
                'is_valid'    => true,
                'verified_at' => now(),
                'patient_id'  => $patient->id,
                ...$claim_source,
            ]);
        }

        foreach ($request->also_known_as as $known_as) {
            PatientAlsoKnownAs::create([
                'patient_id'  => $patient->id,
                ...$known_as,
            ]);
        }

        $appointment->referral->update([
            'referring_doctor_id' => $request->referring_doctor_id,
            'referral_date' => Carbon::create($request->referral_date)->toDateString(),
            'referral_duration' => $request->referral_duration,
            'is_no_referral' => false,
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
     * Confirm
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $appointment = Appointment::find($request->id);

        // Verify the user can access this function via policy
        $this->authorize('update', $appointment);

        $appointment->confirmation_status = 'CONFIRMED';

        $appointment->save();

        return response()->json(
            [
                'message' => 'Appointment confirmed',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Appointment wait listed
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function waitListed(Request $request)
    {
        $appointment = Appointment::find($request->id);

        // Verify the user can access this function via policy
        $this->authorize('waitListed', $appointment);

        $appointment->is_wait_listed = (bool)$request->is_wait_listed;

        $appointment->save();

        $message = 'Appointment removed from wait listed';

        if ($appointment->is_wait_listed) {
            $message = 'Appointment added to wait listed';
        }

        return response()->json(
            [
                'message' => $message,
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    public function aptEndTime(Request $request)
    {
        $startTime = Carbon::create($request->start_time);
        $organization = User::find($request->specialist_id)->organization()->first();
        $appointmentType = AppointmentType::find($request->appointment_type_id)->first();
        return Carbon::create($startTime)->addMinutes($organization->appointment_length * $appointmentType->AppointmentLengthAsNumber);
    }
}
