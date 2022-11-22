<?php

namespace App\Models;

use App\Enum\PatientBillingType;
use PDF;
use Carbon\Carbon;
use App\Mail\Notification;
use App\Mail\PaymentConfirmationEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'confirmed_by',
        'amount',
        'payment_type',
        'is_deposit',
        'is_send_receipt',
        'invoice_number',
    ];

    protected $appends = [
        'confirmed_user_name',
        'full_invoice_number',
    ];
    
    public function getConfirmedUserNameAttribute()
    {
        return $this->confirmed_user->first_name .' '. $this->confirmed_user->last_name;
    }

    public function getFullInvoiceNumberAttribute()
    {
        $organization = $this->appointment->organization;
        $code = strtoupper($organization->code);
        $number = sprintf('%06d', $this->invoice_number);

        return $code . $number;
    }

    /**
     * Return Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    /**
     * Return Confirmed User
     */
    public function confirmed_user()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    /**
     * translate template
     */
    public function translate($template, $data)
    {
        $appointment = $this->appointment;
        $patient = $appointment->patient();
        $clinic = $appointment->clinic;

        $patient_name = $patient->title . ' ' . $patient->first_name . ' ' . $patient->last_name;
        $clinic_name = $clinic->name;

        $words = [
            '[patient]'                     => $patient_name,       ///
            '[amount]'                      => $this->amount,
            '[clinic_name]'                 => $clinic_name,        ///
            '[total_amount]'                => '',
            '[amount_paid]'                 => '',
            '[amount_outstanding]'          => '',
            '[user_who_took_the_payment]'   => '',
        ];
        

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }

    public function generateInvoice()
    {
        $details = $this->appointment->detail;

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

        $total_paid = $this->appointment->payments()
                                        ->where('id', '<>', $this->id)
                                        ->sum('amount');

        $medicare_card = $this->appointment->patient->billing()
                                                    ->whereBillingType(PatientBillingType::MEDICARE_CARD)
                                                    ->whereIsValid(true)
                                                    ->orderBy('verified_at', 'desc')
                                                    ->first();
        
        $specialist = $this->appointment->specialist;
        $clinic = $this->appointment->clinic;
        $provider_number = SpecialistClinicRelation::whereSpecialistId($specialist->id)
                                                   ->whereClinicId($clinic->id)
                                                   ->pluck('provider_number')
                                                   ->first();

        $data = [
            'payment' => $this,
            'appointment' => $this->appointment,
            'referral' => $this->appointment->referral,
            'patient' => $this->appointment->patient,
            'clinic' => $clinic,
            'organization' => $this->appointment->organization,
            'specialist' => $specialist,
            'items' => $all_items,
            'total_cost' => $total_cost,
            'total_paid' => $total_paid,
            'bill_from' => $this->appointment->appointment_type->invoice_by,
            'medicare_card' => $medicare_card,
            'provider_number' => $provider_number,
        ];

        return PDF::loadView('pdfs/appointmentPaymentInvoice', $data);
    }

    public function sendInvoice()
    {
        $this->appointment->patient->sendEmail(new PaymentConfirmationEmail($this));
    }
}