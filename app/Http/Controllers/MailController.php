<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Response;
use App\Http\Requests\MailRequest;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 'draft';

        $mail_list = Mail::where('from_user_id', auth()->user()->id)
            ->orderByDesc('sent_at')
            ->orderByDesc('updated_at');

        if ($request->filled('status')) {
            $status = $request->status;
        }

        $mail_list->where('status', $status);

        $mail_list = $mail_list->get();

        return response()->json(
            [
                'message' => ucfirst($status) . ' Mail List',
                'data' => $mail_list,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(MailRequest $request, Mail $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail)
    {
        //
    }
}
