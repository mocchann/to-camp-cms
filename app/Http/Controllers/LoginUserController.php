<?php

namespace App\Http\Controllers;

use App\UseCase\Users\UserLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginUserController
{
    public function index(): View
    {
        return view('user_login.index');
    }

    public function store(Request $request, UserLogin $use_case): RedirectResponse
    {
        $result = $use_case->execute($request->email, $request->password);

        if ($result === false) {
            return redirect()->route('login');
        }

        return redirect()->route('camp_grounds.index');
    }
}
