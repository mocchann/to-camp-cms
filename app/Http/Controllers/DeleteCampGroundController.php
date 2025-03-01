<?php

namespace App\Http\Controllers;

use App\UseCase\CampGrounds\DeleteCampGround;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteCampGroundController extends Controller
{
    public function delete(Request $request, DeleteCampGround $use_case): RedirectResponse
    {
        $use_case->execute($request->id);

        return redirect()->route('camp_grounds.index');
    }
}
