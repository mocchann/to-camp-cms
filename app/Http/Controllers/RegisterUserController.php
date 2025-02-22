<?php

namespace App\Http\Controllers;

use App\UseCase\Users\UserRegister;
use Illuminate\Http\Request;

class RegisterUserController
{
    public function index()
    {
        return view('user_register.index');
    }

    public function store(Request $request, UserRegister $use_case)
    {
        $result = $use_case->execute(
            $request->id,
            $request->name,
            $request->email,
            $request->password
        );

        if ($result === false) {
            return redirect()->route('user_register.index')->with('error', 'User already exists');
        }

        return redirect()->route('camp_grounds.index');
    }
}
