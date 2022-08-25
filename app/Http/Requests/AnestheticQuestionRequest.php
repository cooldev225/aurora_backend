<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
* @bodyParam question   string  required  The text content for the anesthetic question     Example: "Have you undergone any major surgeries?"
*/
class AnestheticQuestionRequest extends FormRequest
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
            'question' => 'required|string'
        ];
    }
    
}
