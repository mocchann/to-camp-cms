<?php

namespace App\Http\Controllers;

use App\UseCase\Users\UserLogin;
use Illuminate\Http\Request;

class LoginUserController
{
    public function index()
    {
        return view('user_login.index');
    }

    public function store(Request $request, UserLogin $use_case)
    {
        $result = $use_case->execute($request->email, $request->password);

        if ($result) {
            return redirect()->route('camp_grounds.index');
        }

        return redirect()->route('user_login.index');
    }
}
