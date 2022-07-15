<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\UserRoleRequest;
use App\Mail\NotificationEmail;
use App\Models\UserRole;
use Illuminate\Http\Request;

class NotificationTestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function testSendNotification(Request $request)
    {
        $method = $request->method;

        if ($method == 'sms') {
            $to = $request->to;
            $message = $request->message;
            NotificationEmail::sendSMS($to, $message);
        } else {
            $to = $request->to;
            $subject = $request->subject;
            $message = $request->message;
            NotificationEmail::sendEmail($to, $subject, $message);
        }

        return response()->json(
            [
                'message' => 'Test Success',
            ],
            Response::HTTP_CREATED
        );
    }
}
