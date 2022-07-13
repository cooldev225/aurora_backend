<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'days_before'           => 'required|numeric',
            'subject'               => 'required|string|min:2|max:100',
            'sms_template'          => 'required|string',
            'email_print_template'  => 'required|string',
        ];
    }
}
