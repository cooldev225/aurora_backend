<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleItemStoreRequest extends FormRequest
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
            'name'            => 'required|string',
            'description'     => 'string',
            'amount'          => 'required|numeric',
            'mbs_item_code'   => 'string|max:5',
            'icd_code'        => 'string|max:10',
        ];
    }
}
