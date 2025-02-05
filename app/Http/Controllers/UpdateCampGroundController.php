<?php

namespace App\Http\Controllers;

use App\UseCase\CampGrounds\GetCampGround;
use App\UseCase\CampGrounds\UpdateCampGround;
use App\UseCase\CampGrounds\UpdateCampGroundCommand;
use Illuminate\Http\Request;

class UpdateCampGroundController extends Controller
{
    public function index(string $id, GetCampGround $use_case)
    {
        $camp_ground = $use_case->execute($id);

        return view('update_camp_ground.index', ['camp_ground' => $camp_ground]);
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
