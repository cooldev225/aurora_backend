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
    protected $appends = [
        'patient_name', 'patient_details', 'specialist_name',
        'appointment_type', 'aus_formatted_date', 'formatted_appointment_time',
        'is_pre_admission_form_complete', 'referral','clinic_details'
    ];


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
        return $this->specialist->title .' '. $this->specialist->first_name .' '. $this->specialist->last_name;  
    }

    public function getClinicDetailsAttribute()
    {   
        return [
            'name' => $this->clinic()->first()->name,
        ];
    }

    public function getPatientNameAttribute() {
        $patient = $this->patient;
        return [
            'full' => $patient->title .' ' . $patient->first_name .' '.$patient->last_name,
            'first'=> $patient->first_name,
            'last' => $patient->last_name
        ];
    }

    public function getPatientDetailsAttribute() {
        $patient = $this->patient;
        return [
            'date_of_birth' => Carbon::parse( $patient ->date_of_birth)->format('d-m-Y'),
            'contact_number'=>  $patient ->contact_number,
            'email'=>  $patient ->email,
      ];
    }

    public function getIsPreAdmissionFormCompleteAttribute() {
        if($this->preAdmission->pre_admission_file){
            return true;
        }
        return false;
    }


    public function getReferralAttribute() {
        return $this->referral()->first();
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
     * Return Patient that the appointment belongs to
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
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
     * Return AppointmentReferral
     */
    public function referral()
    {
        return $this->hasOne(AppointmentReferral::class);
    }
    
    /**
     * Return Return Payments
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
        );
    }

    /**
     * Return Pre Admission
     */
    public function preAdmission()
    {
        return $this->hasOne(AppointmentPreAdmission::class);
    }

    public function specialist(){
        return $this->hasOne(User::class, 'id','specialist_id');
     }

     public function anesthetist(){
        return $this->hasOne(User::class,'id', 'anesthetist_id');
     }

    /**
     * Return Recall NotificationTemplate
     */
    public function recallNotificationTemplate()
    {
        return NotificationTemplate::where('type', 'recall')->first();
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
        $patient = $this->patient;

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
            
            '[AppointmentType]'     => $this->type->name,
            '[Specialist]'          => $this->specialist->full_name,
            
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
