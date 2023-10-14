<?php

namespace App\View\Components\Form;

use App\Models\Client;
use Illuminate\View\Component;

class WebsiteForm extends Component
{
    public function render()
    {
        return view('components.form.website-form',[
            'clients' => Client::select('id', 'client_name')->get()
        ]);
    }
}
