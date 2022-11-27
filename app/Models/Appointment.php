<?php

namespace App\Models;

use Carbon\Carbon;
use App\Mail\Notification;
use App\Mail\IssueInvoiceEmail;
use App\Enum\PatientBillingType;
use App\Mail\GenericNotificationEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PDF;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'organization_id', 'clinic_id', 'appointment_type_id',
        'specialist_id', 'room_id', 'anesthetist_id', 'is_wait_listed',
        'procedure_approval_status', 'confirmation_status', 'attendance_status',
        'date', 'arrival_time', 'start_time', 'end_time', 'charge_type',
        'note', 'collecting_person_name', 'collecting_person_phone',
        'collecting_person_alternate_contact', 'draft_status', 'created_by'
    ];
    protected $appends = [
        'patient_name', 'patient_details', 'specialist_name', 'anesthetist_name', 'appointment_type_name',
        'aus_formatted_date', 'formatted_appointment_time',
        'is_pre_admission_form_complete', 'clinic_details', 'creator_name'
    ];


    public function getAusFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }

    public function getAppointmentTypeNameAttribute()
    {
        return $this->appointment_type->name;
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

    public function getCreatorNameAttribute()
    {
        if(!$this->createdUser()) {
            return null;
        }
        return $this->createdUser->title .' '. $this->createdUser->first_name .' '. $this->createdUser->last_name;
    }

    public function getAnesthetistNameAttribute()
    {
        if ($this->anesthetist) {
            return $this->anesthetist->first_name .' '. $this->anesthetist->last_name;
        }
        return null;
    }

    public function getClinicDetailsAttribute()
    {
        return [
            'name' => $this->clinic->name,
        ];
    }

    public function getPatientNameAttribute() {
        $patient = $this->patient;
        if ($patient) {
            return [
                'full' => $patient->title .' ' . $patient->first_name .' '.$patient->last_name,
                'first'=> $patient->first_name,
                'last' => $patient->last_name
            ];
        }
       return null;
    }

    public function getPatientDetailsAttribute() {
        $patient = $this->patient;
        if (!$patient) {
            return null;
        }
        return [
            'date_of_birth' => Carbon::parse( $patient ->date_of_birth)->format('d-m-Y'),
            'contact_number'=>  $patient ->contact_number,
            'email'=>  $patient ->email,
      ];
    }

    public function getIsPreAdmissionFormCompleteAttribute() {
        if ($this->pre_admission) {
            if($this->pre_admission->pre_admission_file){
                return true;
            }
        }
        return false;
    }


    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Return Organization
     */
    public function detail()
    {
        return $this->hasOne(AppointmentDetail::class);
    }

    /**
     * Return Organization
     */
    public function documents()
    {
        return $this->hasMany(PatientDocument::class);
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
        return $this->belongsTo(Clinic::class);
    }

    /**
     * Return Appointment Type
     */
    public function appointment_type()
    {
        return $this->belongsTo(AppointmentType::class);
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
        return $this->hasMany(AppointmentPayment::class);
    }

    /**
     * Return Pre Admission
     */
    public function pre_admission()
    {
        return $this->hasOne(AppointmentPreAdmission::class);
    }

    /**
     * Return Room
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function specialist()
    {
        return $this->hasOne(User::class, 'id','specialist_id');
    }

    public function anesthetist()
    {
        return $this->hasOne(User::class,'id', 'anesthetist_id');
    }

    public function createdUser()
    {
        return $this->hasOne(User::class,'id', 'created_by');
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
    /**
     * translates and appointment into the given template
     */
    public function translate( $template){

        $preadmission_url = 'https://dev.aurorasw.com.au/#/appointment_pre_admissions/show/'
            . md5($this->id) . '/form_1';

        $confirm_url = 'https://dev.aurorasw.com.au/#/appointment/'
            . md5($this->id) . '/confirm';

        $words = [
            '[PatientFirstName]' => $this->patient->first_name,
            '[PatientLastName]'  => $this->patient->last_name,

            '[AppointmentTime]'     => $this->start_time,
            '[AppointmentFullDate]' => Carbon::create($this->date)->format('d/m/Y'),
            '[AppointmentDate]'     => Carbon::create($this->date)->format('jS, F'),
            '[AppointmentDay]'      => Carbon::create($this->date)->format('l'),

            '[AppointmentType]'     => $this->appointment_type->name,
            '[Specialist]'          => $this->specialist->full_name,

            '[ClinicName]'          => $this->clinic->name,
            '[ClinicPhone]'         => $this->clinic->phone_number,

            '[ClinicAddress]'       => $this->clinic->address,
            '[ClinicEmail]'         => $this->clinic->email,

            '[PreAdmissionURL]'     => $preadmission_url,
            '[ConfirmURL]'          => $confirm_url,
        ];

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }

    public function sendNotification($type){

        $notificationTemplate =   $this->organization->notificationTemplates->where('type', $type)->first();
        $channel = $this->patient->appointment_confirm_method;
        $patient = $this->patient;
        $template = $channel == 'SMS' ? $notificationTemplate->sms_template : $notificationTemplate->email_print_template;

        $data = [
            'subject' => $notificationTemplate->subject,
            'message' => $this->translate($template),
        ];

        if ($channel == 'sms') {
            $patient->sendSms($data['message']);
        } elseif ($channel == 'email') {
            $patient->sendEmail(new GenericNotificationEmail($data['subject'], $data['message']));
        }
    }

    public function generateInvoice()
    {
        $data = $this->invoiceData();

        $data = [
            'full_invoice_number' => generateInvoiceNumber($this->organization, $this),
            'total_paid' => $this->payments()->sum('amount'),
            'payments' => $this->payments()->orderBy('created_at', 'desc')->get(),
            ...$data,
        ];

        return PDF::loadView('pdfs/appointmentPaymentInvoice', $data);
    }

    public function sendInvoice()
    {
        $this->patient->sendEmail(new IssueInvoiceEmail($this));
    }

    public function invoiceData()
    {
        $details = $this->detail;

        $items = array_merge(
            $details->procedures_undertaken ?? [],
            $details->extra_items_used ?? [],
            $details->admin_items ?? []
        );

        $all_items = [];
        $total_cost = 0;
        foreach ($items as &$item) {
            $schedule_item = ScheduleItem::find($item['id'])->toArray();
            $all_items[] = [
                ...$schedule_item,
                'price' => $item['price'],
            ];
            $total_cost += $item['price'];
        }

        $medicare_card = $this->patient->billing()
                            ->whereBillingType(PatientBillingType::MEDICARE_CARD)
                            ->whereIsValid(true)
                            ->orderBy('verified_at', 'desc')
                            ->first();

        $specialist = $this->specialist;
        $clinic = $this->clinic;
        $provider_number = SpecialistClinicRelation::whereSpecialistId($specialist->id)
                                                   ->whereClinicId($clinic->id)
                                                   ->pluck('provider_number')
                                                   ->first();

        return [
            'appointment' => $this,
            'referral' => $this->referral,
            'patient' => $this->patient,
            'clinic' => $clinic,
            'organization' => $this->organization,
            'specialist' => $specialist,
            'items' => $all_items,
            'total_cost' => $total_cost,
            'bill_from' => $this->appointment_type->invoice_by,
            'medicare_card' => $medicare_card,
            'provider_number' => $provider_number,
        ];
    }
}
