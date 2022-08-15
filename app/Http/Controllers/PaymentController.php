<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentPaymentRequest;
use App\Models\Appointment;
use App\Models\AppointmentPayment;
use Illuminate\Http\Response;
use App\Mail\Notification;

class PaymentController extends BaseOrganizationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $paymentList = Appointment::
            where('organization_id', auth()->user()->organization_id)
            ->whereIn('confirmation_status', ['PENDING', 'CONFIRMED'])
            ->where('date', '>=', date('Y-m-d'))
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
            ->toArray();

        return response()->json(
            [
                'message' => 'Payment List',
                'data'    => $paymentList,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Display a item of the Payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
      
        $appointmentType = $appointment->type();

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
            'paid_amount'       => $appointment->payments()->sum('amount'),
        );

        return response()->json(
            [
                'message' => 'Payment Detail Info',
                'data' =>  [
                    'appointment'   => $appointment->toArray(),
                    'payment'       => $paymentData,
                    'payment_list'  => $appointment->payments()->get()
                ]
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        AppointmentPaymentRequest $request, )
    {
 
        $payment = AppointmentPayment::create([
            'appointment_id'    => $request->appointment_id,
            'confirmed_by'      => auth()->user()->id,
            'amount'            => $request->amount,
            'payment_type'      => $request->payment_type,
            'is_deposit'        => $request->is_deposit,
            'is_send_receipt'   => $request->is_send_receipt,
            'email'             => $request->email,
        ]);

        Notification::sendPaymentNotification($payment, 'payment_made');

        return response()->json(
            [
                'message' => 'Appointment payment confirmed'
            ],
            Response::HTTP_CREATED
        );
    }
}
