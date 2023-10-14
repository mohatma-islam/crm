<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'client_name' => 'required|max:255',
            'client_account_manager_id' => 'required',
            'client_postal_address' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'client_account_manager_id' => 'The account manager field is required.',
        ];
    }
}
