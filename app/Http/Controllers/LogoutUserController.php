<?php

namespace App\Http\Controllers;

use App\UseCase\Users\UserLogout;
use Illuminate\Http\Request;

class LogoutUserController
{
    public function store(Request $request, UserLogout $use_case)
    {
        $use_case->execute($request->session());

        return redirect()->route('login');
    }
}
