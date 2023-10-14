<?php

namespace App\View\Components\form;

use App\Models\Website;
use Illuminate\View\Component;

class HostingDetailForm extends Component
{
    public function render()
    {
        return view('components.form.hosting-detail-form',[
            'websites' => Website::get()
        ]);
    }
}
