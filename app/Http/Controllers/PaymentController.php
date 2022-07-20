<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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

}
