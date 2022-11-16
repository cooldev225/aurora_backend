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
            'admin_items' => [],
        ];

        if ($appointment->detail->procedures_undertaken) {
            foreach ($appointment->detail->procedures_undertaken as $procedure) {
                $schedule_item = ScheduleItem::whereId($procedure['id'])
                                             ->whereOrganizationId($organization_id)
                                             ->with('schedule_fees')
                                             ->first()
                                             ->toArray();
                
                $charges['procedures'][] = [
                    ...$schedule_item,
                    'schedule_fees' => $schedule_item['schedule_fees'],
                    'price'         => $procedure['price'],
                ];
            }
        }

        if ($appointment->detail->extra_items_used) {
            foreach ($appointment->detail->extra_items_used as $extra_item) {
                $schedule_item = ScheduleItem::whereId($extra_item['id'])
                                             ->whereOrganizationId($organization_id)
                                             ->with('schedule_fees')
                                             ->first()
                                             ->toArray();
                
                $charges['extra_items'][] = [
                    ...$schedule_item,
                    'schedule_fees' => $schedule_item['schedule_fees'],
                    'price'         => $extra_item['price'],
                ];
            }
        }

        if ($appointment->detail->admin_items) {
            foreach ($appointment->detail->admin_items as $admin_item) {
                $schedule_item = ScheduleItem::whereId($admin_item['id'])
                                             ->whereOrganizationId($organization_id)
                                             ->with('schedule_fees')
                                             ->first()
                                             ->toArray();
                
                $charges['admin_items'][] = [
                    ...$schedule_item,
                    'schedule_fees' => $schedule_item['schedule_fees'],
                    'price'         => $admin_item['price'],
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
        
        $data = $request->validated();
        $data['amount'] = $data['amount'] * 100;

        $payment = AppointmentPayment::create([
            ...$data,
            'confirmed_by' => auth()->user()->id,
        ]);

        if ($payment->is_send_receipt) {
            $payment->appointment->patient->sendEmail(new PaymentConfirmationEmail());
        }

        return response()->json(
            [
                'message' => 'Appointment payment confirmed'
            ],
            Response::HTTP_CREATED
        );
    }
}
