<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\ICampGroundFileRepository;
use Illuminate\Http\UploadedFile;

class UploadCampGroundImage
{
    public function __construct(private ICampGroundFileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UploadedFile $image_file): string
    {
        return $this->repository->uploadImage($image_file);
    }
}
