<?php

namespace App\Domain\Models\CampGrounds;

use Illuminate\Http\UploadedFile;

interface ICampGroundFileRepository
{
    public function uploadImage(UploadedFile $uploaded_file): string;
}
