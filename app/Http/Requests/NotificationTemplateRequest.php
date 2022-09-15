<?php

namespace App\Http\Requests;

use App\Enum\NotificationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
* @bodyParam type                   enum     required   The type of notification (SMS, MAIL, EMAIL)                 Example: SMS
* @bodyParam days_before            int      required   The number of days before the notification should be sent   Example: 5
* @bodyParam subject                string              The subject of the notification (required if not SMS)
* @bodyParam sms_template           string              The SMS template of the notification (required if SMS)
* @bodyParam email_print_template   string              The email or print template (required if not SMS)
*/
class NotificationTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type'                  => ['required', new Enum(NotificationType::class)],
            'days_before'           => 'required|numeric',
            'subject'               => 'required_unless:type,SMS|string|min:2|max:100',
            'sms_template'          => 'required_if:type,SMS|string',
            'email_print_template'  => 'required_unless:type,SMS|string',
        ];
    }
}
