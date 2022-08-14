<?php

namespace App\Models;

use App\Mail\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'organization_id', 'clinic_id', 'appointment_type_id',
        'specialist_id', 'room_id', 'anesthetist_id', 'is_wait_listed',
        'procedure_approval_status', 'confirmation_status', 'attendance_status',
        'date', 'arrival_time', 'start_time', 'end_time', 'charge_type',
        'note', 'collecting_person_name', 'collecting_person_phone',
        'collecting_person_alternate_contact',
    ];
    protected $appends = array('specialist_name','appointment_type','aus_formatted_date','formatted_appointment_time');

    public function getAusFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('d-m-Y'); 
    }

    public function getFormattedAppointmentTimeAttribute()
    {
        $start = Carbon::parse($this->start_time)->format('H:i');
        $end = Carbon::parse($this->end_time)->format('H:i');
        return $start . "-" . $end; 
    }

    public function getSpecialistNameAttribute()
    {
        $specialist_user = $this->specialist()->employee()->user();
        return 'Dr ' .$specialist_user->first_name .' '. $specialist_user->last_name;  
    }

    public function getAppointmentTypeAttribute()
    {
        return $this->appointmentType()->first();
    }


    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

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
     * Return Appointment Type
     */
    public function appointmentType()
    {
        return $this->belongsTo(AppointmentType::class, 'appointment_type_id');
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
     * Return AppointmentReferral
     */
    public function referral()
    {
        return $this->hasOne(AppointmentReferral::class);
    }
    
    /**
     * Return AppointmentAdministrationInfo
     */
    public function payments()
    {
        return $this->hasMany(AppointmentPayment::class, 'appointment_id');
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
     * Return AppointmentAdministrationInfo
     */
    public function pre_admission()
    {
        return $this->hasOne(AppointmentPreAdmission::class);
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
        $patient = $this->patient();
        $specialist = $this->specialist();
        $specialist_employee = $specialist->employee();
        $specialist_user = $specialist_employee->user();
        $specialist_title = $specialist->specialist_title;
        $specialist_name = $specialist_title->name . ' '
            . $specialist_user->first_name . ' ' . $specialist_user->last_name;

        $clinic = $this->clinic;

        $preadmission_url = 'https://dev.aurorasw.com.au/#/appointment_pre_admissions/show/'
            . md5($this->id) . '/form_1';

        $confirm_url = 'https://dev.aurorasw.com.au/#/appointment/'
            . md5($this->id) . '/confirm';

        $words = [
            '[PatientFirstName]' => $patient->first_name,
            '[PatientLastName]'  => $patient->last_name,

            '[AppointmentTime]'     => $this->start_time,
            '[AppointmentFullDate]' => date('d/m/Y', strtotime($this->date)),
            '[AppointmentDate]'     => date('jS, F', strtotime($this->date)),
            '[AppointmentDay]'      => date('l', strtotime($this->date)),
            
            '[AppointmentType]'     => $this->type()->name,
            '[Specialist]'          => $specialist_name,
            
            '[ClinicName]'          => $this->clinic->name,
            '[ClinicPhone]'         => $clinic->phone_number,
            
            '[ClinicAddress]'       => $clinic->address,
            '[ClinicEmail]'         => $clinic->email,

            '[PreAdmissionURL]'     => $preadmission_url,
            '[ConfirmURL]'          => $confirm_url,
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

    public static function withPreAdmission($anesthetist_employee_id) {
        $appointment_table = (new Appointment())->getTable();
        $appointment_type_table = (new AppointmentType())->getTable();
        $patient_table = (new Patient())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $specialist_title_table = (new SpecialistTitle())->getTable();
        $employee_table = (new Employee())->getTable();
        $user_table = (new User())->getTable();

        return Appointment::select(
                $appointment_table.'.*',
                $appointment_table.'.id as appointment_id',
                $patient_table.'.*',
                $appointment_type_table.'.name as appointment_type',
                DB::raw(
                    "CONCAT({$specialist_title_table}.name, ' ', "
                    . "{$user_table}.first_name, ' ', "
                    . "{$user_table}.last_name) AS specialist_name"
                )
            )->leftJoin(
                $patient_table,
                'patient_id',
                $patient_table . ".id"
            )->leftJoin(
                $appointment_type_table,
                'appointment_type_id',
                $appointment_type_table . '.id'
            )->leftJoin(
                $specialist_table,
                'specialist_id',
                $specialist_table . '.id'
            )->leftJoin(
                $specialist_title_table,
                'specialist_id',
                $specialist_title_table . '.id'
            )->leftJoin(
                $employee_table,
                'employee_id',
                $employee_table . '.id'
            )->leftJoin(
                $user_table,
                'user_id',
                $user_table . '.id'
            )->where(
                $appointment_table . '.anesthetist_id',
                $anesthetist_employee_id
            );
    }

    public static function sendAppointmentConfirmNotification() {
        $arrTemplates = NotificationTemplate::where('type', 'appointment_confirmation')
            ->get();

        foreach ($arrTemplates as $template) {
            $organization_id = $template->organization_id;
            $days_before = $template->days_before;
            $appointment_date = date('Y-m-d', strtotime("+" . $days_before . " days"));

            $appointments = Appointment::where('organization_id', $organization_id)
                ->where('date', $appointment_date)
                ->get();

            foreach ($appointments as $appointment) {
                Notification::sendAppointmentNotification($appointment, 'appointment_confirmation', $template);
            }
        }
    }
    
    public static function sendAppointmentReminderNotification() {
        $arrTemplates = NotificationTemplate::where('type', 'appointment_reminder')
            ->get();

        foreach ($arrTemplates as $template) {
            $organization_id = $template->organization_id;
            $days_before = $template->days_before;
            $appointment_date = date('Y-m-d', strtotime("+" . $days_before . " days"));

            $appointments = Appointment::where('organization_id', $organization_id)
                ->where('date', $appointment_date)
                ->get();

            foreach ($appointments as $appointment) {
                Notification::sendAppointmentNotification($appointment, 'appointment_reminder', $template);
            }
        }
    }
}
