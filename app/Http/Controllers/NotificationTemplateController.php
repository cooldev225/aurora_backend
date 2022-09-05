<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\NotificationTemplate;
use App\Http\Requests\NotificationTemplateRequest;

class NotificationTemplateController extends BaseOrganizationController
{
    /**
     * [Notification Template] - List
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
     * [Notification Template] - Store
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
     * [Notification Template] - Update
     *
     * @param  \App\Http\Requests\NotificationTemplateRequest  $request
     * @param  \App\Models\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(
        NotificationTemplateRequest $request,
        NotificationTemplate $notificationTemplate
    ) {
        // Check if the user is authorized to update the associated organization
        $this->authorize('update', $notificationTemplate->organization);

        $notificationTemplate->update([
            'organization_id' => auth()->user()->organization_id,
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
     * [Notification Template] - Destroy
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
