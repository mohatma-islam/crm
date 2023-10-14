<?php

namespace App\View\Components\Form;

use App\Models\User;
use Illuminate\View\Component;

class ClientForm extends Component
{
    public function render()
    {
        $users = User::
        select('id','user_name')
        ->get();
        return view('components.form.client-form',[
            'users' => $users
        ]);
    }
}
