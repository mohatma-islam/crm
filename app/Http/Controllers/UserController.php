<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function authenticate(UserRequest $request)
    {

        $formFields = $request->validated();

        if(auth()->attempt($formFields)) {

            $request->session()->regenerate();

            return redirect(route('dashboard'));

        }

        return back()->withErrors(['user_email' => 'Invalid Credentials, Please Try again!'])->onlyInput('user_email');

    }

    public function create_token()
    {
        return view('user.create_token');
    }

    public function store_token(Request $request)
    {
        $request->validate([
            'token_name' => ['required']
        ]);
    
        $token = $request->user()->createToken($request->token_name);
    
        return back()->with('success_message', 'Token was created, make sure to copy this: '.
        $token->plainTextToken);
    }


    public function destroy()
    {
        auth()->logout();
        session()->flush();
        return redirect('/login');
    }
}
