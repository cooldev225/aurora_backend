<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\EmailTemplate;
use App\Http\Requests\EmailTemplateRequest;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emailTemplate = EmailTemplate::all()->toArray();

        return response()->json(
            [
                'message' => 'Email Template List',
                'data' => $emailTemplate,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
