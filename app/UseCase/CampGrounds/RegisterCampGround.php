<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\CampGround;
use App\Domain\Models\CampGrounds\CampGroundAddress;
use App\Domain\Models\CampGrounds\CampGroundId;
use App\Domain\Models\CampGrounds\CampGroundImage;
use App\Domain\Models\CampGrounds\CampGroundName;
use App\Domain\Models\CampGrounds\CampGroundPrice;
use App\Domain\Models\CampGrounds\CampGroundStatus;
use App\Domain\Models\CampGrounds\ICampGroundRepository;

class RegisterCampGround
{
    public function __construct(
        private ICampGroundRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function execute(RegisterCampGroundCommand $command): CampGround
    {
        $camp_ground = new CampGround(
            new CampGroundId($command->getId()),
            new CampGroundName($command->getName()),
            new CampGroundAddress($command->getAddress()),
            new CampGroundPrice($command->getPrice()),
            new CampGroundImage($command->getImage()),
            new CampGroundStatus($command->getStatus())
        );

        return $this->repository->save($camp_ground);
    }
}
