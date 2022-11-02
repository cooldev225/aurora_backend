<?php

namespace App\Http\Controllers;

use App\Enum\NotificationMethod;
use App\Http\Requests\AppointmentPaymentRequest;
use App\Models\Appointment;
use App\Models\AppointmentPayment;
use Illuminate\Http\Response;
use App\Mail\Notification;
use App\Notifications\PaymentConfirmationNotification;

class PaymentController extends Controller
{
    /**
     * [Payment] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Appointment::class);

        $paymentList = Appointment::where('organization_id', auth()->user()->organization_id)
                                  ->whereIn('confirmation_status', ['PENDING', 'CONFIRMED'])
                                  ->where('date', '>=', date('Y-m-d'))
                                  ->orderBy('date')
                                  ->orderBy('start_time')
                                  ->with('payments')
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
     * [Payment] - Show
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        // Verify the user can access this function via policy
        $this->authorize('view', [Appointment::class, $appointment]);
        $this->authorize('viewAny', AppointmentPayment::class);

        return response()->json(
            [
                'message' => 'Payment Detail Info',
                'data' =>  [
                    'appointment'   => $appointment->toArray(),
                    'payment_list'  => $appointment->payments,
                    'paid_amount'   => $appointment->payments()->sum('amount'),
                ]
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Payment] - Store
     *
     * @param  \App\Http\Requests\AppointmentPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentPaymentRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', AppointmentPayment::class);

        $payment = AppointmentPayment::create([
            $request->validated(),
            'confirmed_by' => auth()->user()->id,
        ]);

        if ($payment->is_send_receipt) {
            PaymentConfirmationNotification::method($payment->notification_method)
                                           ->send($payment->sent_to, $payment);
        }

        return response()->json(
            [
                'message' => 'Appointment payment confirmed'
            ],
            Response::HTTP_CREATED
        );
    }
}
