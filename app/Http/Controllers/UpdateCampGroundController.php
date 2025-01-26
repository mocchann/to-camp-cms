<?php

namespace App\Http\Controllers;

use App\UseCase\CampGrounds\UpdateCampGround;
use App\UseCase\CampGrounds\UpdateCampGroundCommand;
use Illuminate\Http\Request;

class UpdateCampGroundController extends Controller
{
    public function index()
    {
        return view('update_camp_ground.index');
    }

    public function update(Request $request, UpdateCampGround $use_case)
    {
        $command = new UpdateCampGroundCommand(
            $request->id,
            $request->name,
            $request->address,
            $request->price,
            $request->image,
            $request->status,
            $request->location,
            $request->elevation
        );

        $use_case->execute($command);

        return redirect()->route('camp_grounds.index');
    }
}
