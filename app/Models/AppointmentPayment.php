<?php

namespace App\Models;

use PDF;
use Carbon\Carbon;
use App\Mail\Notification;
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

        $data = [
            'payment' => $this,
            'appointment' => $this->appointment,
            'patient' => $this->appointment->patient,
            'clinic' => $this->appointment->clinic,
            'organization' => $this->appointment->organization,
            'items' => $all_items,
            'total_cost' => $total_cost,
            'total_paid' => $total_paid,
        ];

        return PDF::loadView('pdfs/appointmentPaymentInvoice', $data);
    }
}