<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\Mailbox;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\MailRequest;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    /**
     * [Mail] - List
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
                ->get()
                ->toArray();
        } else {
            $mail_list = Mail::select(
                '*',
                "{$mail_table}.id",
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

            $sent_mail_list = Mail::where('from_user_id', auth()->user()->id);

            if ($status == 'deleted') {
                $mail_list->where("{$mailbox_table}.status", $status);

                $sent_mail_list = $sent_mail_list
                    ->where('status', $status)
                    ->orderByDesc('sent_at');
            } else {
                $mail_list->where("{$mailbox_table}.status", 'inbox');
            }

            if ($status == 'unread') {
                $mail_list->where('is_read', false);
            } elseif ($status == 'starred') {
                $mail_list->where("{$mailbox_table}.is_starred", true);

                $sent_mail_list = $sent_mail_list
                    ->whereNot('status', 'deleted')
                    ->where('is_starred', true)
                    ->orderByDesc('sent_at');
            }

            $mail_list = $mail_list->get()->toArray();

            if (in_array($status, ['starred', 'deleted'])) {
                $mail_ids = [];

                foreach ($mail_list as $mail) {
                    $mail_ids[] = $mail['id'];
                }

                $sent_mail_list->whereNotIn('id', $mail_ids);
                $sent_mail_list = $sent_mail_list->get()->toArray();

                $mail_list = array_merge($mail_list, $sent_mail_list);
            }
        }

        $returnMails = [];
        $threadIds = [];

        foreach ($mail_list as $mail) {
            if (empty($mail['thread_id']) || (!in_array($mail['thread_id'], $threadIds))) {
                $threadIds[] = $mail['thread_id'];
                $returnMails[] = $mail;
            }
        }

        return response()->json(
            [
                'message' => ucfirst($status) . ' Mail List',
                'data' => $this->withAttachmentLinks($returnMails),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Change attachment json string to Array.
     */
    protected function withAttachmentLinks($mail_list)
    {
        $base_url = url('/');

        foreach ($mail_list as $key => $mail) {
            $attachment_list = json_decode($mail['attachment']);

            $attachments_with_base_url = [];

            if (!empty($attachment_list)) {
                foreach ($attachment_list as $path) {
                    if (substr($path, 0, 1) == '/') {
                        $attachments_with_base_url[] = $base_url . $path;
                    } else {
                        $attachments_with_base_url[] = $path;
                    }
                }
            }

            $mail_list[$key]['attachment'] = $attachments_with_base_url;
        }

        return $mail_list;
    }

    /**
     * [Mail] - Store
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailRequest $request)
    {
        return response()->json(
            [
                'message' => 'New Mail Created',
                'data' => $this->createMail($request),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Mail] - Show
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

        if (!empty($mailbox)) {
            $mailbox->is_read = true;
            $mailbox->save();
        }

        $replied_mails = [$mail];

        while ($mail->reply_id > 0) {
            $mail = $mail->reply;

            $replied_mails[] = $mail;
        }

        return response()->json(
            [
                'message' => 'Replied Mail List',
                'data' => $this->withAttachmentLinks($replied_mails),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Mail] - Send
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function send(MailRequest $request)
    {
        $mail = $this->createMail($request);

        return $this->sendSavedDraft($mail->id);
    }

    /**
     * [Mail] - Create
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @return $mail
     */
    protected function createMail(MailRequest $request)
    {
        $to_user_ids = "[{$request->to_user_ids}]";

        $mail = Mail::create([
            ...$this->filterParams($request),
            'to_user_ids' => $to_user_ids,
            'from_user_id' => auth()->user()->id,
            'sent_at' => date('Y-m-d H:i:s'),
        ]);

        if (empty($mail->thread_id)) {
            $mail->thread_id = $mail->id;
            $mail->save();
        }

        return $mail;
    }

    /**
     * [Mail] - Send Draft Mail
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function sendDraft(MailRequest $request)
    {
        $mailId = $request->id;
        $mail = Mail::find($mailId);

        $this->updateMail($request, $mail);

        return $this->sendSavedDraft($mailId);
    }

    /**
     * Send Mail Draft.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    protected function sendSavedDraft($id)
    {
        $mailId = $id;
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
     * [Mail] - Bookmark
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
        $user_id = auth()->user()->id;

        if ($user_id == $mail->from_user_id) {
            $mail->update([
                'is_starred' => $request->is_starred,
            ]);
        }

        if (!empty($mailbox) && $user_id == $mailbox->user_id) {
            $mailbox->update([
                'is_starred' => $request->is_starred,
            ]);

            $return = $mailbox;
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
     * [Mail] - Move to Trash
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
        $user_id = auth()->user()->id;

        if ($user_id == $mail->from_user_id) {
            $mail->status = 'deleted';
            $mail->save();
        }

        if (!empty($mailbox) && $user_id == $mailbox->user_id) {
            $mailbox->status = 'deleted';
            $mailbox->save();

            $return = $mailbox;
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
     * [Mail] - Restore from Trash
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
        $user_id = auth()->user()->id;

        if ($user_id == $mail->from_user_id) {
            $mail->status = 'sent';
            $mail->save();
        }

        if (!empty($mailbox) && $user_id == $mailbox->user_id) {
            $mailbox->status = 'inbox';
            $mailbox->save();

            $return = $mailbox;
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
     * [Mail] - Update
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    private function updateMail(MailRequest $request, Mail $mail)
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

        $to_user_ids = "[{$request->to_user_ids}]";

        $mail->update([
            ...$this->filterParams($request),
            'to_user_ids' => $to_user_ids,
            'from_user_id' => auth()->user()->id,
            'sent_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * [Mail] - Update Draft.
     *
     * @param  \App\Http\Requests\MailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDraft(MailRequest $request)
    {
        $mailId = $request->id;
        $mail = Mail::find($mailId);

        return response()->json(
            [
                'message' => 'Mail Draft Updated',
                'data' => $this->updateMail($request, $mail),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Mail] - Destroy
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

        if ($request->filled('attachmentUploaded')) {
            $file_list = json_decode($request->attachmentUploaded);

            foreach ($file_list as $fileInfo) {
                $attachment[] = $fileInfo->url;
            }
        }

        if ($files = $request->file('attachment')) {
            foreach ($files as $file) {
                $file_name = $file->getClientOriginalName();
                $time = time();
                $org_path = getUserOrganizationFilePath('attachments');
                
                if (!$org_path) {
                    return response()->json(
                        [
                            'message'   => 'Could not find user organization',
                        ],
                        Response::HTTP_UNPROCESSABLE_ENTITY
                    );
                }
                
                $file_path = "/{$org_path}/{$time}/{$file_name}";
                Storage::put($file_path, file_get_contents($file));

                $attachment[] = $file_name;
            }
        }

        $attachment = json_encode($attachment);

        return [
            ...$request->all(),
            'attachment' => $attachment,
            'reply_id' =>
                $request->reply_id == 'null' ? null : $request->reply_id,
            'thread_id' =>
                $request->thread_id == 'null' ? null : $request->thread_id,
        ];
    }
}
