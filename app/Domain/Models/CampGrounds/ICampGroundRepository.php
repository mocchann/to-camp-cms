<?php

namespace App\Domain\Models\CampGrounds;

use App\UseCase\CampGrounds\GetCampGroundsCommand;
use App\UseCase\CampGrounds\RegisterCampGroundCommand;
use App\UseCase\CampGrounds\UpdateCampGroundCommand;

interface ICampGroundRepository
{
    public function get(GetCampGroundsCommand $command): array;
    public function find(CampGroundId $id): ?CampGround;
    public function save(RegisterCampGroundCommand $command): CampGround;
    public function update(UpdateCampGroundCommand $command): CampGround;
    public function delete(CampGroundId $id): void;
}
