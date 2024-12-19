<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\ICampGroundRepository;

class GetCampGrounds
{
    public function __construct(private ICampGroundRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        $camp_grounds = $this->repository->findAll();

        return $camp_grounds;
    }
}
