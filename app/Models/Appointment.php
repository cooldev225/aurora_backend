<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'procedure_price',
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
     * Return Clinic
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
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
     * Return Recall NotificationTemplate
     */
    public function recallNotificationTemplate()
    {
        return NotificationTemplate::where('type', 'recall')->first();
    }

    /**
     * Return $appointments
     */
    public static function organizationAppointments($organization_id = null)
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

    /**
     * Return Joined Eloquent with AppointmentType
     */
    public static function organizationAppointmentsWithType(
        $organization_id = null
    ) {
        $appointment_type_table = (new AppointmentType())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $clinic_table = (new Clinic())->getTable();
        $appointment_table = (new Appointment())->getTable();
        $employee_table = (new Employee())->getTable();
        $user_table = (new User())->getTable();
        $specialist_title_table = (new SpecialistTitle())->getTable();

        return self::organizationAppointments($organization_id)
            ->select(
                '*',
                DB::raw(
                    "CONCAT({$specialist_title_table}.name, ' ', {$user_table}.first_name, ' ', {$user_table}.last_name) AS specialist_name"
                ),
                "{$clinic_table}.name AS clinic_name",
                "{$appointment_type_table}.name AS procedure_name",
                "{$appointment_type_table}.name AS appointment_type_name",
                "{$appointment_table}.patient_id"
            )
            ->leftJoin(
                $appointment_type_table,
                'appointment_type_id',
                '=',
                "{$appointment_type_table}.id"
            )
            ->leftJoin($clinic_table, 'clinic_id', '=', "{$clinic_table}.id")
            ->leftJoin(
                $employee_table,
                'employee_id',
                '=',
                $employee_table . '.id'
            )
            ->leftJoin($user_table, 'user_id', '=', $user_table . '.id')
            ->leftJoin(
                $specialist_title_table,
                'specialist_title_id',
                '=',
                $specialist_title_table . '.id'
            );
    }

    /**
     * translate Recall message template
     */
    protected function recallTranslate()
    {
        $template = $this->recallNotificationTemplate();

        return $this->translate($template);
    }

    /**
     * translate template
     */
    public function translate($template)
    {
        $words = [
            '[PatientFirstName]' => $this->patient()->first_name,
            '[Time]' => $this->start_time,
            '[Date]' => $this->date,
            '[ClinicName]' => $this->clinic->name,
        ];

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }

    /**
     * Check conflict
     */
    public function checkConflict($start_time, $end_time)
    {
        if ($this->start_time >= $end_time) {
            return false;
        }

        if ($this->end_time <= $start_time) {
            return false;
        }

        return true;
    }
}
