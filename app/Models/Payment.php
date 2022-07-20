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
        $patient_table = (new Patient())->getTable();
        $arrConfirmationStatus = array(
            'PENDING', 'CONFIRMED'
        );

        return Appointment::where('organization_id', $organization_id)
            ->select(
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
            ->get();
    }

    /**
     * Return Joined Eloquent with AppointmentType
     */
    public static function paymentDetailInfo($appointment) {
        $appointmentData = $appointment;
        $appointmentData['patient'] = $appointment->patient();
        $appointmentData['specialist'] = $appointment->specialist();
        $appointmentData['type'] = $appointment->type();

        return $appointmentData;
    }
}
