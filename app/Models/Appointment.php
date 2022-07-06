<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'organization_id',
        'clinic_id',
        'appointment_type_id',
        'primary_pathologist_id',
        'specialist_id',
        'room_id',
        'anesthetist_id',
        'reference_number',
        'is_wait_listed',
        'procedure_approval_status',
        'confirmation_status',
        'attendance_status',
        'date',
        'arrival_time',
        'start_time',
        'end_time',
        'actual_arrival_time',
        'actual_start_time',
        'actual_end_time',
        'charge_type',
        'payment_status',
        'skip_coding',
    ];

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id')->first();
    }

    /**
     * Return Specialist
     */
    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id')->first();
    }

    /**
     * Return AppointmentAdministrationInfo
     */
    public function administrationInfo()
    {
        return $this->hasOne(
            AppointmentAdministrationInfo::class,
            'appointment_id'
        )->first();
    }

    /**
     * Return AppointmentType
     */
    public function type()
    {
        return $this->belongsTo(
            AppointmentType::class,
            'appointment_type_id'
        )->first();
    }

    /**
     * Return $appointments
     */
    public static function appointmentsForOrganization($organization_id = null)
    {
        if ($organization_id == null) {
            $organization_id = auth()->user()->organization_id;
        }

        $appointment_table = (new Appointment())->getTable();
        $patient_table = (new Patient())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $appointment_administration_info_table = (new AppointmentAdministrationInfo())->getTable();
        $patient_billing_table = (new PatientBilling())->getTable();

        $appointments = self::select('*', "{$appointment_table}.*")
            ->leftJoin(
                $specialist_table,
                'specialist_id',
                '=',
                "{$specialist_table}.id"
            )
            ->leftJoin($patient_table, 'patient_id', '=', "{$patient_table}.id")
            ->leftJoin(
                $patient_billing_table,
                "{$patient_billing_table}.patient_id",
                '=',
                "{$patient_table}.id"
            )
            ->leftJoin(
                $appointment_administration_info_table,
                'appointment_id',
                '=',
                "{$appointment_table}.id"
            )
            ->where($appointment_table . '.organization_id', $organization_id);

        return $appointments;
    }
}
