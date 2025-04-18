<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCampGroundRequest;
use App\UseCase\CampGrounds\GetCampGround;
use App\UseCase\CampGrounds\UpdateCampGround;
use App\UseCase\CampGrounds\UpdateCampGroundCommand;
use App\UseCase\CampGrounds\UploadCampGroundImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UpdateCampGroundController extends Controller
{
    public function index(string $id, GetCampGround $use_case): View
    {
        $camp_ground = $use_case->execute($id);

        return view('update_camp_ground.index', ['camp_ground' => $camp_ground]);
    }

    public function update(
        UpdateCampGroundRequest $request,
        UpdateCampGround $update_use_case,
        UploadCampGroundImage $upload_use_case
    ): RedirectResponse {
        $image_path = $request->image ? $upload_use_case->execute($request->image) : $request->image_file_path;

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
