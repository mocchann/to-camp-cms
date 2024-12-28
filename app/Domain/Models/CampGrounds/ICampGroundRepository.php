<?php

namespace App\Domain\Models\CampGrounds;

use App\UseCase\CampGrounds\RegisterCampGroundCommand;
use App\UseCase\CampGrounds\UpdateCampGroundCommand;

interface ICampGroundRepository
{
    public function get(GetCampGroundsFilter $filter): array;
    public function find(CampGroundId $id): ?CampGround;
    public function save(RegisterCampGroundCommand $command): CampGround;
    public function update(UpdateCampGroundCommand $command): CampGround;
    public function delete(CampGroundId $id): void;
}
