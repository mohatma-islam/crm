<?php

namespace App\View\Components\form;

use App\Models\Website;
use Illuminate\View\Component;

class ServiceLevelForm extends Component
{
    public function render()
    {
        return view('components.form.service-level-form',[
            'websites' => Website::get()
        ]);
    }
}
