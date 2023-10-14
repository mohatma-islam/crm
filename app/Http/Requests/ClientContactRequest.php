<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientContactRequest extends FormRequest
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
            'client_contact_first_name' => 'required|max:255',
            'client_contact_surname' => 'required|max:255',
            'client_email_address' => 'required|email',
            'client_phone_number' => 'required|min:10'
        ];
    }

    public function messages()
    {
        return [
            'client_id' => 'The client name field is required.',
        ];
    }
}
