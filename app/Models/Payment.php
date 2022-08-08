<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Payment
{
    /**
     * Return Joined Eloquent with AppointmentType
     */
    public static function organizationPaymentList(
        $organization_id = null
    ) {
        $appointment_table = (new Appointment())->getTable();
        $patient_table = (new Patient())->getTable();
        $arrConfirmationStatus = array(
            'PENDING', 'CONFIRMED'
        );

        return Appointment::where('organization_id', $organization_id)
            ->select(
                $appointment_table . '.id',
                'clinic_id',
                'date',
                'start_time',
                'end_time',
                'attendance_status',
                'confirmation_status',
                DB::raw(
                    "CONCAT(" . $patient_table . ".title, ' ', "
                    . $patient_table . ".first_name, ' ', "
                    . $patient_table . ".last_name) AS patient_name"
                ),
            )
            ->leftJoin(
                $patient_table,
                'patient_id',
                $patient_table . ".id"
            )
            ->where('date', '<=', date('Y-m-d'))
            ->whereIn('confirmation_status', $arrConfirmationStatus)
            ->orderBy('date', 'ASC')
            ->orderBy('start_time', 'ASC')
            ->orderBy('end_time', 'ASC')
            ->get();
    }

    /**
     * Return Joined Eloquent with AppointmentType
     */
    public static function paymentDetailInfo($appointment) {
        $appointmentData = $appointment;
        $patient = $appointment->patient();
        $appointmentType = $appointment->type();
        $specialistUser = $appointment->specialist()->employee()->user();
        $appointmentPayments = AppointmentPayment::select(
                DB::raw('SUM(amount) AS paid_amount')
            )->where('appointment_id', $appointment->id)
            ->get();
        $paid_amount = $appointmentPayments[0]->paid_amount ?
            $appointmentPayments[0]->paid_amount : 0;

        $patientData = array(
            'first_name'        => $patient->first_name,
            'last_name'         => $patient->last_name,
            'address'           => $patient->address,
            'contact_number'    => $patient->contact_number,
            'date_of_birth'     => $patient->date_of_birth,
            'charge_type'       => $appointment->charge_type,
        );
        $appointmentData = array(
            'id'                => $appointment->id,
            'type'              => $appointmentType->type,
            'name'              => $appointmentType->name,
            'date'              => $appointment->date,
            'start_time'        => $appointment->start_time,
            'end_time'          => $appointment->end_time,
        );
        $specialistData = array(
            'first_name' => $specialistUser->first_name,
            'last_name' => $specialistUser->last_name,
        );
        $paymentData = array(
            'payment_tier_1'    => $appointmentType->payment_tier_1,
            'payment_tier_2'    => $appointmentType->payment_tier_2,
            'payment_tier_3'    => $appointmentType->payment_tier_3,
            'payment_tier_4'    => $appointmentType->payment_tier_4,
            'payment_tier_5'    => $appointmentType->payment_tier_5,
            'payment_tier_6'    => $appointmentType->payment_tier_6,
            'payment_tier_7'    => $appointmentType->payment_tier_7,
            'payment_tier_8'    => $appointmentType->payment_tier_8,
            'payment_tier_9'    => $appointmentType->payment_tier_9,
            'payment_tier_10'   => $appointmentType->payment_tier_10,
            'payment_tier_11'   => $appointmentType->payment_tier_11,
            'paid_amount'       => $paid_amount,
        );

        $paymentList = AppointmentPayment::where('appointment_id', $appointment->id)
            ->with('confirmed_user')
            ->get()->toArray();

        return array(
            'patient'       => $patientData,
            'appointment'   => $appointmentData,
            'specialist'    => $specialistData,
            'payment'       => $paymentData,
            'payment_list'  => $paymentList,
        );
    }
}
