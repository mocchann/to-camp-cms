<?php

namespace App\Domain\Models\CampGrounds;

use Illuminate\Http\UploadedFile;

interface ICampGroundRepository
{
    public function get(GetCampGroundsFilter $filter): array;

    public function findById(CampGroundId $id): ?CampGround;

    public function uploadImage(UploadedFile $image_file): string;

    public function update(CampGround $camp_ground): CampGround;

    public function delete(CampGroundId $id): void;
}
