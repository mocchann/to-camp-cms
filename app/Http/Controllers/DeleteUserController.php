<?php

namespace App\Http\Controllers;

use App\UseCase\Users\UserDelete;
use Illuminate\Http\RedirectResponse;

class DeleteUserController extends Controller
{
    public function delete(UserDelete $use_case): RedirectResponse
    {
        $use_case->execute();

        return redirect()->route('login');
    }
}
