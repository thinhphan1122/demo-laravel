<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $incomingFieldValues = $request->validate([
            'login-name' => 'required',
            'login-password' => 'required'
        ]);

        if (auth()->attempt(['name' => $incomingFieldValues['login-name'], 'password' =>$incomingFieldValues['login-password']])) {
            $request->session()->regenerate();
        }

        return redirect('/home');
    }

    public function logout()
    {
        auth()->logout();
        return redirect("/home");
    }


    public function register(Request $request)
    {
        $incomingFieldValues = $request->validate([
            'name' => ['required', 'min:3', 'max:200', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200']
        ]);

        $incomingFieldValues['password'] = bcrypt($incomingFieldValues['password']);
        $user = User::create($incomingFieldValues);
        auth()->login($user);
        return redirect('/home');
    }
}
