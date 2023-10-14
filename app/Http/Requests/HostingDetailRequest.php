<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HostingDetailRequest extends FormRequest
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
            'forge_server_id' => 'required',
            'host_name' => 'required|max:255',
            'host_username' => 'required|max:255',
            'host_password' => 'required|max:255',
            'host_port_number' => 'required|max:255',
            'server_supplier_lookup_id' => 'required|max:255',
            'connection_type_lookup_id' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'website_id' => 'The website name field is required.',
            'forge_server_id' => 'The Server name field is required',
            'server_supplier_lookup_id' => 'The Supplier Name field is required',
            'connection_type_lookup_id' => 'The Connection Type field is required'
        ];
    }
}
