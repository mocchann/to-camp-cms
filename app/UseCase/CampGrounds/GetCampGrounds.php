<?php

namespace App\UseCase\CampGrounds;

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
