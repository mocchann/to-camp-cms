<?php

namespace App\EF\CampGrounds;

use App\Domain\Models\CampGrounds\CampGround;
use App\Domain\Models\CampGrounds\CampGroundId;
use App\Domain\Models\CampGrounds\GetCampGroundsFilter;
use App\Domain\Models\CampGrounds\ICampGroundRepository;

class CampGroundRepository implements ICampGroundRepository
{
    public function get(GetCampGroundsFilter $filter): array
    {
        return [];
    }

    public function findById(CampGroundId $id): ?CampGround
    {
        return null;
    }

    public function update(CampGround $camp_ground): CampGround
    {
        return $camp_ground;
    }

    public function delete(CampGroundId $id): void {}
}
