<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
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
            'client_id' => 'required',
            'deal_stage_id' => 'required|max:255',
            'estimated_deal' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'client_id' => 'The client name field is required.',
            'deal_stage_id' => 'The Stage name field is required.'
        ];
    }
}
