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
    public function show(Appointment $appointment)
    {
        // $today = date('Y-m-d');

        // $patientInfo = Patient::patientDetailInfo($patient->id)
        //     ->first()
        //     ->toArray();

        // $patientInfo['appointments'] = $patient->getAppointmentsWithSpecialist();

        return response()->json(
            [
                'message' => 'Payment Detail Info',
                // 'data' => $patientInfo,
            ],
            Response::HTTP_OK
        );
    }

}
