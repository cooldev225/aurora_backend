<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentPaymentRequest;
use App\Models\Appointment;
use App\Models\AppointmentPayment;
use App\Models\Payment;
use Illuminate\Http\Response;

class PaymentController extends BaseOrganizationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $paymentList = Payment::organizationPaymentList($organization_id);

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
    public function show($appointment_id)
    {
        $organization_id = auth()->user()->organization_id;
        $appointment = Appointment::find($appointment_id);

        if ($appointment == null
            || $appointment->organization_id != $organization_id
        ) {
            return response()->json(
                [
                    'message'   => 'Payment Detail Info',
                    'data'      => null,
                ],
                Response::HTTP_OK
            );
        }

        $paymentInfo = Payment::paymentDetailInfo($appointment);

        return response()->json(
            [
                'message' => 'Payment Detail Info',
                'data' => $paymentInfo,
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
    public function store(AppointmentPaymentRequest $request)
    {
        $user_id = auth()->user()->id;
        $appointment_id = $request->appointment_id;
        $appointment = Appointment::find($appointment_id);

        AppointmentPayment::create([
            'appointment_id'    => $appointment_id,
            'confirmed_by'      => $user_id,
            'amount'            => $request->amount,
            'payment_type'      => $request->payment_type,
        ]);
        $paymentInfo = Payment::paymentDetailInfo($appointment);

        return response()->json(
            [
                'message' => 'Appointment payment confirmed',
                'data' => $paymentInfo,
            ],
            Response::HTTP_CREATED
        );
    }
}
