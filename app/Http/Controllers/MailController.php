<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\MailRequest;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = 'inbox';

        if ($request->filled('status')) {
            $status = $request->status;
        }

        $mail_list = null;

        if (in_array($status, ['draft', 'sent'])) {
            $mail_list = Mail::where('from_user_id', auth()->user()->id)
                ->where('status', $status)
                ->orderByDesc('sent_at')
                ->orderByDesc('updated_at');
        } else {
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
        }

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
        $mail = Mail::create([
            ...$request->all(),
            'from_user_id' => auth()->user()->id,
        ]);

        return response()->json(
            [
                'message' => 'New Mail Created',
                'data' => $mail,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {
        $available_user_ids = json_decode($mail->to_user_ids);

        $available_user_ids[] = $mail->from_user_id;

        $current_user_id = auth()->user()->id;

        if (in_array($current_user_id, $available_user_ids)) {
            return response()->json(
                [
                    'message' => 'Only available for sender or receiver',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $mailbox = $mail->mailbox;

        $mailbox->update('is_read', true);
        $mailbox->save();

        $replied_mails = [$mail];

        while ($mail->reply_id > 0) {
            $mail = $mail->reply;

            $replied_mails[] = $mail;
        }

        return response()->json(
            [
                'message' => 'Replied Mail List',
                'data' => $replied_mails,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Bookmark Mail.
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @param  $mailId
     * @return \Illuminate\Http\Response
     */
    public function bookmark(MailRequest $request, $mailId)
    {
        $mailbox = Mail::find($mailId)->mailbox;

        if (auth()->user()->id == $mailbox->user_id) {
            return response()->json(
                [
                    'message' => 'Not Mailbox owner',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $mailbox->update([
            'is_starred' => true,
        ]);

        return response()->json(
            [
                'message' => 'Mail Bookmarked',
                'data' => $mailbox,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Move to Trash.
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @param  $mailId
     * @return \Illuminate\Http\Response
     */
    public function delete(MailRequest $request, $mailId)
    {
        $mailbox = Mail::find($mailId)->mailbox;

        if (auth()->user()->id == $mailbox->user_id) {
            return response()->json(
                [
                    'message' => 'Not Mailbox owner',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $mailbox->update([
            'status' => 'deleted',
        ]);

        return response()->json(
            [
                'message' => 'Mail Deleted',
                'data' => $mailbox,
            ],
            Response::HTTP_OK
        );
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
        if (auth()->user()->id == $mail->from_user_id) {
            return response()->json(
                [
                    'message' => 'Not Mail draft creator',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        if ($mail->status != 'draft') {
            return response()->json(
                [
                    'message' => 'Mail update forbidden',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $mail->update([
            ...$request->all(),
            'from_user_id' => auth()->user()->id,
        ]);

        return response()->json(
            [
                'message' => 'Mail Updated',
                'data' => $mail,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail)
    {
        if ($mail->status != 'draft') {
            return response()->json(
                [
                    'message' => 'Mail destroy forbidden',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $mail->delete();

        return response()->json(
            [
                'message' => 'Mail Draft Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
