<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCampGroundRequest;
use App\UseCase\CampGrounds\UpdateCampGround;
use App\UseCase\CampGrounds\UpdateCampGroundCommand;

class CreateCampGroundController extends Controller
{
    public function index()
    {
        return view('create_camp_ground.index');
    }

    public function create(CreateCampGroundRequest $request, UpdateCampGround $use_case)
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
