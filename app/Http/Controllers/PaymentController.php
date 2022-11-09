<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentPaymentRequest;
use App\Mail\PaymentConfirmationEmail;
use App\Models\Appointment;
use App\Models\AppointmentPayment;
use Illuminate\Http\Response;
use App\Models\ScheduleItem;

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

        $user = auth()->user();
        $organization_id = $user->organization->id;

        $charges = [
            'procedures'  => [],
            'extra_items' => [],
        ];

        if ($appointment->detail->procedures_undertaken) {
            foreach ($appointment->detail->procedures_undertaken as $procedure) {
                $schedule_item = ScheduleItem::whereId($procedure)
                                             ->whereOrganizationId($organization_id)
                                             ->with('schedule_fees')
                                             ->first()
                                             ->toArray();
                
                $charges['procedures'][] = [
                    ...$schedule_item,
                    'schedule_fees' => $schedule_item['schedule_fees'],
                    'price'         => $schedule_item['amount'] / 100,
                ];
            }
        }

        if ($appointment->detail->extra_items) {
            foreach ($appointment->detail->extra_items as $extra_item) {
                $schedule_item = ScheduleItem::whereId($extra_item)
                                             ->whereOrganizationId($organization_id)
                                             ->with('schedule_fees')
                                             ->first()
                                             ->toArray();
                
                $charges['procedures'][] = [
                    ...$schedule_item,
                    'schedule_fees' => $schedule_item['schedule_fees'],
                    'price'         => $schedule_item['amount'] / 100,
                ];
            }
        }

        return response()->json(
            [
                'message' => 'Payment Detail Info',
                'data' =>  [
                    'appointment'   => $appointment,
                    'charges'       => $charges,
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
            ...$request->validated(),
            'confirmed_by' => auth()->user()->id,
        ]);

        if ($payment->is_send_receipt) {
            $payment->patient->sendEmail(new PaymentConfirmationEmail());
        }

        return response()->json(
            [
                'message' => 'Appointment payment confirmed'
            ],
            Response::HTTP_CREATED
        );
    }
}
