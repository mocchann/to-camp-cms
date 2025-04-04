<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\UseCase\Users\UserLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginUserController
{
    public function index(): View
    {
        return view('user_login.index');
    }

    public function store(LoginUserRequest $request, UserLogin $use_case): RedirectResponse
    {
        $result = $use_case->execute($request->email, $request->password);

        if ($result === false) {
            return redirect()->route('login')->with('error', 'email or password is incorrect');
        }

        return redirect()->route('camp_grounds.index');
    }
}
