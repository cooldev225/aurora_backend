<?php

namespace App\Http\Controllers;

use App\Models\Mailbox;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class MailboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 'inbox';

        if ($request->filled('status')) {
            $status = $request->status;
        }

        $mail_list = Mail::with([
            'mailbox' => function ($query) use ($status) {
                $query->where('user_id', auth()->user()->id);

                if ($status == 'deleted') {
                    $query->where('status', $status);
                } else {
                    $query->where('status', 'inbox');
                }

                if ($status == 'unread') {
                    $query->where('is_read', false);
                } elseif ($status == 'starred') {
                    $query->where('is_starred', true);
                }
            },
        ])->orderByDesc('sent_at');

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mailbox  $mailbox
     * @return \Illuminate\Http\Response
     */
    public function show(Mailbox $mailbox)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mailbox  $mailbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mailbox $mailbox)
    {
        //
    }
}
