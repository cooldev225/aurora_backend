<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\EmailTemplate;
use App\Http\Requests\EmailTemplateRequest;

class EmailTemplateController extends Controller
{
    /**
     * [Email Template] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emailTemplate = EmailTemplate::all();

        return response()->json(
            [
                'message' => 'Email Template List',
                'data' => $emailTemplate,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Email Template] - Store
     *
     * @param  \App\Http\Requests\EmailTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailTemplateRequest $request)
    {
        $emailTemplate = EmailTemplate::create([
            'key' => $request->key,
            'type' => $request->type,
            'hint' => $request->hint,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return response()->json(
            [
                'message' => 'New Email Template created',
                'data' => $emailTemplate,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Email Template] - Update
     *
     * @param  \App\Http\Requests\EmailTemplateRequest  $request
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(
        EmailTemplateRequest $request,
        EmailTemplate $emailTemplate
    ) {
        $emailTemplate->update([
            'key' => $request->key,
            'type' => $request->type,
            'hint' => $request->hint,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return response()->json(
            [
                'message' => 'Email Template updated',
                'data' => $emailTemplate,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Email Template] - Destroy
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();

        return response()->json(
            [
                'message' => 'Email Template Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
