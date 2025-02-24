<?php

namespace App\UseCase\Users;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class UserLogout
{
    public function execute(Session $session)
    {
        Auth::logout();

        $session->invalidate();

        $session->regenerateToken();
    }
}
