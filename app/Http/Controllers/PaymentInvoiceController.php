<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AppointmentPayment;
use App\Http\Requests\PaymentInvoiceSendRequest;

class PaymentInvoiceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send(PaymentInvoiceSendRequest $request, Appointment $appointment, AppointmentPayment $appointmentPayment)
    {
        $this->authorize('view', $appointmentPayment);

        $appointmentPayment->sendInvoice($request->email);

        return response()->json(
            [
                'message' => 'Invoice sent',
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment, AppointmentPayment $appointmentPayment)
    {
        $this->authorize('view', $appointmentPayment);

        $pdf = $appointmentPayment->generateInvoice();

        return response($pdf->output(), Response::HTTP_OK)
               ->header('Content-Type', 'application/pdf');
    }
}
