<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\PatientBilling;
use App\Mail\Notification;
use App\Models\AppointmentPreAdmission;
use App\Models\AppointmentReferral;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*
        $appointment_table = (new Appointment())->getTable();

        $appointments = Appointment::organizationAppointmentsWithType()->orderBy(
            "{$appointment_table}.date"
        );

        $return = ['today' => [], 'tomorrow' => [], 'future' => []];
        $today = date('Y-m-d');

        $status = $request->status;

        if ($status == 'unconfirmed') {
            $appointments->where('confirmation_status', 'PENDING');

            $tomorrow = date_create($today);
            date_add($tomorrow, date_interval_create_from_date_string('1 day'));
            $tomorrow = date_format($tomorrow, 'Y-m-d');

            $appointments = $appointments
                ->where("{$appointment_table}.date", '>=', $today)
                ->get();

            foreach ($appointments as $appointment) {
                if ($appointment->date == $today) {
                    $return['today'][] = $appointment;
                }

                if ($appointment->date == $tomorrow) {
                    $return['tomorrow'][] = $appointment;
                }

                if ($appointment->date > $tomorrow) {
                    $return['future'][] = $appointment;
                }
            }
        } elseif ($status == 'unapproved') {
            $appointments->where('procedure_approval_status', 'NOT_APPROVED');

            $return = $appointments
                ->where("{$appointment_table}.date", '>=', $today)
                ->get();
        } elseif ($status == 'wait-listed') {
            $appointments->where('is_wait_listed', true);

            $return = $appointments
                ->where("{$appointment_table}.date", '>=', $today)
                ->get();
        } elseif ($status == 'cancellation') {
            $appointments->where('confirmation_status', 'CANCELED');

            $return = $appointments->get();
        } elseif ($status == 'available') {
            $appointments
                ->where('procedure_approval_status', 'APPROVED')
                ->where('confirmation_status', 'CONFIRMED')
                ->where("{$appointment_table}.date", '>=', $today);

            $appointments = $appointments->get();

            $search_dates = [];
            $appointment_date = date_create($today);

            for ($i = 0; $i < 7; $i++) {
                $search_dates[] = date_format($appointment_date, 'Y-m-d');
                date_add(
                    $appointment_date,
                    date_interval_create_from_date_string('1 day')
                );
            }

            $return = [];

            foreach ($search_dates as $search_date) {
                $formatted_date = date('D jS', strtotime($search_date));
                $return[$formatted_date] = [];

                foreach ($appointments as $appointment) {
                    if ($appointment->date == $search_date) {
                        $return[$formatted_date][] = $appointment;
                    }
                }
            }
        }*/

        // Verify the user can access this function via policy
        $this->authorize('viewAny', Appointment::class);

        return response()->json(
            [
                'message' => 'Not Implemented',
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
     * @param  \App\Http\Requests\AppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
                'first_name'                    => $request->first_name,
                'last_name'                     => $request->last_name,
                'date_of_birth'                 => Carbon::create($request->date_of_birth)->toDateString(),
                'contact_number'                => $request->contact_number,
                'address'                       => $request->address,
                'email'                         => $request->email,
                'appointment_confirm_method'    => $request->appointment_confirm_method,
                'allergies'                     => $request->allergies,
                'clinical_alerts'               => $request->clinical_alerts,
            ]);
            $patient->billing()->update([
                'medicare_number'                => $request->medicare_number,
                'medicare_reference_number'      => $request->medicare_reference_number,
                'medicare_expiry_date'           => $request->medicare_expiry_date,
                'concession_number'              => $request->concession_number,
                'concession_expiry_date'         => $request->concession_expiry_date,
                'pension_number'                 => $request->pension_number,
                'pension_expiry_date'            => $request->pension_expiry_date,
                'healthcare_card_number'         => $request->healthcare_card_number,
                'healthcare_card_expiry_date'    => $request->healthcare_card_expiry_date,
                'health_fund_id'                 => $request->health_fund_id,
                'health_fund_membership_number'  => $request->health_fund_membership_number,
                'health_fund_reference_number'   => $request->health_fund_reference_number,
                'health_fund_expiry_date'        => $request->health_fund_expiry_date,
             ]);
        } else {
            // Verify the user can access this function via policy
            $this->authorize('create', Patient::class);
            $this->authorize('create', PatientBilling::class);

            $patient = Patient::create([
                'first_name'                    => $request->first_name,
                'last_name'                     => $request->last_name,
                'date_of_birth'                 => Carbon::create($request->date_of_birth)->toDateString(),
                'contact_number'                => $request->contact_number,
                'address'                       => $request->address,
                'email'                         => $request->email,
                'appointment_confirm_method'    => $request->appointment_confirm_method,
                'allergies'                     => $request->allergies,
                'clinical_alerts'               => $request->clinical_alerts,
            ]);

            PatientBilling::create([
                'patient_id'                     => $patient->id, 
                'medicare_number'                => $request->medicare_number,
                'medicare_reference_number'      => $request->medicare_reference_number,
                'medicare_expiry_date'           => $request->medicare_expiry_date,
                'concession_number'              => $request->concession_number,
                'concession_expiry_date'         => $request->concession_expiry_date,
                'pension_number'                 => $request->pension_number,
                'pension_expiry_date'            => $request->pension_expiry_date,
                'healthcare_card_number'         => $request->healthcare_card_number,
                'healthcare_card_expiry_date'    => $request->healthcare_card_expiry_date,
                'health_fund_id'                 => $request->health_fund_id,
                'health_fund_membership_number'  => $request->health_fund_membership_number,
                'health_fund_reference_number'   => $request->health_fund_reference_number,
                'health_fund_expiry_date'        => $request->health_fund_expiry_date,  
            ]);

            $patient->organizations()->attach(Organization::find(auth()->user()->organization_id));
        }

        $start_time = Carbon::create($request->time_slot[0]);
        $end_time = Carbon::create($request->time_slot[1]);

        $appointment = Appointment::create([
            'date'                          => $request->date, 
            'arrival_time'                  => $request->arrival_time,
            'start_time'                    => $start_time->toTimeString(),
            'end_time'                      => $end_time->toTimeString(),
            'patient_id'                    => $patient->id,
            'organization_id'               => auth()->user()->organization_id,
            'appointment_type_id'           => $request->appointment_type_id,
            'clinic_id'                     => $request->clinic_id,
            'specialist_id'                 => $request->specialist_id,
            'anesthetist_id'                => User::find($request->specialist_id)->hrmUserBaseSchedulesTimeDay($start_time->timestamp,strtoupper(Carbon::parse($request->date)->format('D')))?->anesthetist_id,
            'note'                          => $request->note,
            'charge_type'                   => $request->charge_type,     
        ]);

        AppointmentReferral::create([
            'appointment_id'                => $appointment->id,
            'referring_doctor_id'           => $request->referring_doctor_id,
            'referral_date'                 => $request->referring_doctor_id,
            'referral_duration'             => $request->referral_duration,
            'is_no_referral'                => false,
        ]);

        AppointmentPreAdmission::create([
            'appointment_id'                => $appointment->id,
            'token'                         => md5($appointment->id)
        ]);

        Notification::sendAppointmentNotification($appointment, 'appointment_booked');

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
     * @param  \App\Http\Requests\AppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $appointment);
        $this->authorize('update', $appointment->patient);
        $this->authorize('update', $appointment->patient->billing);
        $this->authorize('update', $appointment->referral);
      
        $appointment->update([
            'appointment_type_id'           => $request->appointment_type_id,
            'room_id'                       => $request->room_id,
            'note'                          => $request->note,
            'charge_type'                   => $request->charge_type,
            'end_time'                      => Carbon::create($request->time_slot[1])->toTimeString(),
        ]);

        $appointment->patient()->update([
            'first_name'                    => $request->first_name,
            'last_name'                     => $request->last_name,
            'date_of_birth'                 => Carbon::create($request->date_of_birth)->toTimeString(),
            'contact_number'                => $request->contact_number,
            'address'                       => $request->address,
            'email'                         => $request->email,
            'appointment_confirm_method'    => $request->appointment_confirm_method,
            'allergies'                     => $request->allergies,
            'clinical_alerts'               => $request->clinical_alerts,
        ]);


        $appointment->patient()->billing()->update([
           'medicare_number'                => $request->medicare_number,
           'medicare_reference_number'      => $request->medicare_reference_number,
           'medicare_expiry_date'           => $request->medicare_expiry_date,
           'concession_number'              => $request->concession_number,
           'concession_expiry_date'         => $request->concession_expiry_date,
           'pension_number'                 => $request->pension_number,
           'pension_expiry_date'            => $request->pension_expiry_date,
           'healthcare_card_number'         => $request->healthcare_card_number,
           'healthcare_card_expiry_date'    => $request->healthcare_card_expiry_date,
           'health_fund_id'                 => $request->health_fund_id,
           'health_fund_membership_number'  => $request->health_fund_membership_number,
           'health_fund_reference_number'   => $request->health_fund_reference_number,
           'health_fund_expiry_date'        => $request->health_fund_expiry_date,
        ]);

        $appointment->referral->update([ 
            'referring_doctor_id'           => $request->referring_doctor_id,
            'referral_date'                 => $request->referring_doctor_id,
            'referral_duration'             => $request->referral_duration,
            'is_no_referral'                => false,
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
     * @param  \Illuminate\Http\Request  $request
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function waitListed(Request $request)
    {
        $appointment = Appointment::find($request->id);

        // Verify the user can access this function via policy
        $this->authorize('waitListed', $appointment);

        $appointment->is_wait_listed = (bool) $request->is_wait_listed;

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
}
