<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\NotificationTemplate;
use App\Http\Requests\NotificationTemplateRequest;

class NotificationTemplateController extends BaseOrganizationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $notificationTemplates = NotificationTemplate::where(
            'organization_id',
            $organization_id
        )->get();

        return response()->json(
            [
                'message' => 'Notification Template List',
                'data' => $notificationTemplates,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NotificationTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationTemplateRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $notificationTemplate = NotificationTemplate::create([
            'organization_id' => $organization_id,
            'type' => $request->type,
            'days_before' => $request->days_before,
            'subject' => $request->subject,
            'sms_template' => $request->sms_template,
            'email_print_template' => $request->email_print_template,
        ]);

        return response()->json(
            [
                'message' => 'New Notification Template created',
                'data' => $notificationTemplate,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NotificationTemplateRequest  $request
     * @param  \App\Models\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(
        NotificationTemplateRequest $request,
        NotificationTemplate $notificationTemplate
    ) {
        $organization_id = auth()->user()->organization_id;

        if ($notificationTemplate->organization_id != $organization_id) {
            return $this->forbiddenOrganization();
        }

        $notificationTemplate->update([
            'organization_id' => $organization_id,
            'type' => $request->type,
            'days_before' => $request->days_before,
            'subject' => $request->subject,
            'sms_template' => $request->sms_template,
            'email_print_template' => $request->email_print_template,
        ]);

        return response()->json(
            [
                'message' => 'Notification Template updated',
                'data' => $notificationTemplate,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationTemplate $notificationTemplate)
    {
        $notificationTemplate->delete();

        return response()->json(
            [
                'message' => 'Notification Template Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
