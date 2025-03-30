<?php

namespace App\Repositories\CampGrounds;

use App\Domain\Models\CampGrounds\ICampGroundFileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CampGroundFileRepository implements ICampGroundFileRepository
{
    public function uploadImage(UploadedFile $image_file): string
    {
        return Storage::disk('public')->put($image_file->getPathname(), $image_file);
    }
}
