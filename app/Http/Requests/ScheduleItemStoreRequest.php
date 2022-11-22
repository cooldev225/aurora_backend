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
            'description'     => 'nullable|string',
            'amount'          => 'required|numeric',
            'mbs_item_code'   => 'numeric|max_digits:5',
            'internal_code'   => 'alphanum|max:10|nullable',
        ];
    }
}
