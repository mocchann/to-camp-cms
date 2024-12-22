<?php

namespace App\Domain\Models\CampGrounds;

use App\UseCase\CampGrounds\GetCampGroundsCommand;
use App\UseCase\CampGrounds\RegisterCampGroundCommand;

interface ICampGroundRepository
{
    public function get(GetCampGroundsCommand $command): array;
    public function save(RegisterCampGroundCommand $command): CampGround;
}
