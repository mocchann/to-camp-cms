<?php

namespace App\Domain\Models\CampGrounds;

interface ICampGroundRepository
{
    public function get(GetCampGroundsFilter $filter): array;
    public function findById(CampGroundId $id): ?CampGround;
    public function update(CampGround $camp_ground): CampGround;
    public function delete(CampGroundId $id): void;
}
