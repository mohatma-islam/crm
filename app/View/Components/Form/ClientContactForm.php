<?php

namespace App\View\Components\Form;

use App\Models\Client;
use Illuminate\View\Component;

class ClientContactForm extends Component
{
    public function render()
    {
        return view('components.form.client-contact-form', [
            'clients' => Client::select('id', 'client_name')->get()
        ]);
    }
}
