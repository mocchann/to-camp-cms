<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\UseCase\Users\UserRegister;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterUserController
{
    public function index(): View
    {
        return view('user_register.index');
    }

    public function store(RegisterUserRequest $request, UserRegister $use_case): RedirectResponse
    {
        $result = $use_case->execute(
            $request->id,
            $request->name,
            $request->email,
            $request->password
        );

        if ($result === false) {
            return redirect()->route('register')->with('error', 'user registration failed');
        }

        return redirect()->route('camp_grounds.index');
    }
}
