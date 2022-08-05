<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\Mailbox;
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
        $mailbox_table = (new Mailbox())->getTable();
        $mail_table = (new Mail())->getTable();

        if (in_array($status, ['draft', 'sent'])) {
            $mail_list = Mail::where('from_user_id', auth()->user()->id)
                ->where('status', $status)
                ->orderByDesc('sent_at')
                ->orderByDesc('updated_at');
        } else {
            $mail_list = Mail::select(
                '*',
                "{$mailbox_table}.status",
                "{$mailbox_table}.is_starred",
                "{$mailbox_table}.is_read"
            )
                ->rightJoin(
                    $mailbox_table,
                    "{$mailbox_table}.mail_id",
                    '=',
                    "{$mail_table}.id"
                )
                ->orderByDesc('sent_at');

            $mail_list->where('user_id', auth()->user()->id);

            if ($status == 'deleted') {
                $mail_list->where("{$mailbox_table}.status", $status);
            } else {
                $mail_list->where("{$mailbox_table}.status", 'inbox');
            }

            if ($status == 'unread') {
                $mail_list->where('is_read', false);
            } elseif ($status == 'starred') {
                $mail_list->where("{$mailbox_table}.is_starred", true);
            }
        }

        $mail_list = $mail_list->get()->toArray();
        $base_url = url('/');

        foreach ($mail_list as $key => $mail) {
            $attachment_list = json_decode($mail['attachment']);

            $attachments_with_base_url = [];

            if (!empty($attachment_list)) {
                foreach ($attachment_list as $path) {
                    $attachments_with_base_url[] = $base_url . $path;
                }
            }

            $mail_list[$key]['attachment'] = $attachments_with_base_url;
        }

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
        $to_user_ids = explode(',', $request->to_user_ids);

        $mail = Mail::create([
            ...$this->filterParams($request),
            'to_user_ids' => json_encode($to_user_ids),
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

        if (!in_array($current_user_id, $available_user_ids)) {
            return response()->json(
                [
                    'message' => 'Only available for sender or receiver',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $mailbox = $mail->mailbox;

        $mailbox->is_read = true;
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
     * Send Mail.
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function send(MailRequest $request)
    {
        $to_user_ids = explode(',', $request->to_user_ids);

        $mail = Mail::create([
            ...$this->filterParams($request),
            'to_user_ids' => json_encode($to_user_ids),
            'from_user_id' => auth()->user()->id,
        ]);

        return $this->sendDraft($request, $mail->id);
    }

    /**
     * Send Mail Draft.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendDraft(Request $request, $id)
    {
        $mailId = empty($id) ? $request->id : $id;
        $mail = Mail::find($mailId);

        if (auth()->user()->id != $mail->from_user_id) {
            return response()->json(
                [
                    'message' => 'Not Mail Draft owner',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $to_user_ids = json_decode($mail->to_user_ids);

        foreach ($to_user_ids as $to_user_id) {
            $mailbox = Mailbox::create([
                'user_id' => $to_user_id,
                'mail_id' => $mail->id,
            ]);
        }

        $mail->status = 'sent';
        $mail->sent_at = date('Y-m-d H:i:s');

        $mail->save();

        return response()->json(
            [
                'message' => 'Mail Sent',
                'data' => $mail,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Bookmark Mail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bookmark(Request $request)
    {
        $mailId = $request->id;
        $mail = Mail::find($mailId);
        $mailbox = $mail->mailbox;
        $return = $mail;

        if (auth()->user()->id == $mailbox->user_id) {
            $mailbox->update([
                'is_starred' => $request->is_starred,
            ]);

            $return = $mailbox;
        } elseif (auth()->user()->id == $mail->from_user_id) {
            $mail->update([
                'is_starred' => $request->is_starred,
            ]);
        } else {
            return response()->json(
                [
                    'message' => 'Not Mail Owner',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        return response()->json(
            [
                'message' => 'Mail Bookmarked',
                'data' => $return,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Move to Trash.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $mailId = $request->id;
        $mail = Mail::find($mailId);
        $mailbox = $mail->mailbox;
        $return = $mail;

        if (auth()->user()->id == $mailbox->user_id) {
            $mailbox->update([
                'status' => 'deleted',
            ]);

            $return = $mailbox;
        } elseif (auth()->user()->id == $mail->from_user_id) {
            $mail->update([
                'status' => 'deleted',
            ]);
        } else {
            return response()->json(
                [
                    'message' => 'Not Mail Owner',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        return response()->json(
            [
                'message' => 'Mail Deleted',
                'data' => $return,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Restore from Trash.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $mailId = $request->id;
        $mail = Mail::find($mailId);
        $mailbox = $mail->mailbox;
        $return = $mail;

        if (auth()->user()->id == $mailbox->user_id) {
            $mailbox->update([
                'status' => 'inbox',
            ]);

            $return = $mailbox;
        } elseif (auth()->user()->id == $mail->from_user_id) {
            $mail->update([
                'status' => 'sent',
            ]);
        } else {
            return response()->json(
                [
                    'message' => 'Not Mail Owner',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        return response()->json(
            [
                'message' => 'Mail Restored',
                'data' => $return,
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
        if (auth()->user()->id != $mail->from_user_id) {
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
                    'message' => 'Sent Mail can not be changed',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $to_user_ids = explode(',', $request->to_user_ids);

        $mail->update([
            ...$this->filterParams($request),
            'to_user_ids' => json_encode($to_user_ids),
            'from_user_id' => auth()->user()->id,
        ]);

        return response()->json(
            [
                'message' => 'Mail Draft Updated',
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

    /**
     * Filter Request
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @return Filtered Array
     */
    protected function filterParams(MailRequest $request)
    {
        $attachment = [];

        if ($files = $request->file('attachment')) {
            foreach ($files as $file) {
                $file_name = $file->getClientOriginalName();
                $file_path =
                    '/' .
                    $file->storeAs('files/attachment/' . time(), $file_name);
                $attachment[] = $file_path;
            }
        }

        $attachment = json_encode($attachment);

        return [...$request->all(), 'attachment' => $attachment];
    }
}
