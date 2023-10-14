<?php

namespace App\View\Components\Form;

use App\Models\Website;
use Illuminate\View\Component;

class TechnologyForm extends Component
{
    public function render()
    {
        return view('components.form.technology-form',[
            'websites' => Website::get()
        ]);
    }
}
