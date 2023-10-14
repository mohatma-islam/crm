<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceLevelRequest extends FormRequest
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
            'website_id' => 'required',
            'service_level_lookup_id' => 'required',
            'maintenance_lookup_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'website_id' => 'The Website name field is required.',
            'service_level_lookup_id' => 'The Service Level name is required.',
            'maintenance_lookup_id' => 'The Maintenance name is required.'
        ];
    }
}
