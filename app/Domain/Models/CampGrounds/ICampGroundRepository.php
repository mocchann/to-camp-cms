<?php

namespace App\Domain\Models\CampGrounds;

use App\UseCase\CampGrounds\GetCampGroundsCommand;

interface ICampGroundRepository
{
    public function get(GetCampGroundsCommand $command): array;
}
