<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\CampGround;
use App\Domain\Models\CampGrounds\CampGroundId;
use App\Domain\Models\CampGrounds\ICampGroundRepository;

class GetCampGround
{
    public function __construct(
        private ICampGroundRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function execute(int $id): ?CampGround
    {
        $camp_ground_id = new CampGroundId($id);

        return $this->repository->findById($camp_ground_id);
    }
}
