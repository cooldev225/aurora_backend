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
        $pdf = $appointmentPayment->generateInvoice();

        return response()->make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="test.pdf"',
        ]);
    }
}
