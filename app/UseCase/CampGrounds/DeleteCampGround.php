<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\CampGroundId;
use App\Domain\Models\CampGrounds\ICampGroundRepository;

class DeleteCampGround
{
    public function __construct(private ICampGroundRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): void
    {
        $camp_ground_id = new CampGroundId($id);

        $this->repository->delete($camp_ground_id);
    }
}
