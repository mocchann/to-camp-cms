<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCampGroundRequest;
use App\UseCase\CampGrounds\UpdateCampGround;
use App\UseCase\CampGrounds\UpdateCampGroundCommand;
use App\UseCase\CampGrounds\UploadCampGroundImage;

class CreateCampGroundController extends Controller
{
    public function index()
    {
        return view('create_camp_ground.index');
    }

    public function create(
        CreateCampGroundRequest $request,
        UpdateCampGround $update_use_case,
        UploadCampGroundImage $upload_use_case
    ) {
        $image_path = $upload_use_case->execute($request->image);

        $command = new UpdateCampGroundCommand(
            $request->id,
            $request->name,
            $request->address,
            $request->price,
            $image_path,
            $request->status,
            $request->location,
            $request->elevation
        );

        $update_use_case->execute($command);

        return redirect()->route('camp_grounds.index');
    }
}
