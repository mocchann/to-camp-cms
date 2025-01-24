<?php

namespace App\Http\Controllers;

use App\UseCase\CampGrounds\GetCampGrounds;
use App\UseCase\CampGrounds\GetCampGroundsCommand;
use Illuminate\Http\Request;

class CampGroundsController extends Controller
{
    public function index(Request $request, GetCampGrounds $use_case)
    {
        $command = new GetCampGroundsCommand(
            $request->input('id') ?? null,
            $request->input('name') ?? null,
            $request->input('name') ?? null,
            $request->input('address') ?? null,
            $request->input('price') ?? null,
            $request->input('image') ?? null,
            $request->input('status') ?? null,
            $request->input('locations') ?? null,
            $request->input('elevation') ?? null
        );

        $camp_grounds = $use_case->execute($command);

        return view('camp_grounds.index', ['camp_grounds' => $camp_grounds]);
    }
}
