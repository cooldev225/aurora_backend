<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppointmentInvoiceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send(Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        $appointment->sendInvoice(true);

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
    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        $pdf = $appointment->generateInvoice();

        return response($pdf->output(), Response::HTTP_OK)
               ->header('Content-Type', 'application/pdf');
    }
}
