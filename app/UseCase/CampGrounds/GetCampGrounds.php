<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\GetCampGroundsFilter;
use App\Domain\Models\CampGrounds\ICampGroundRepository;

class GetCampGrounds
{
    public function __construct(private ICampGroundRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetCampGroundsCommand $command): array
    {
        $filter = new GetCampGroundsFilter(
            $command->getId(),
            $command->getName(),
            $command->getAddress(),
            $command->getPrice(),
            $command->getImage(),
            $command->getStatus()
        );

        return $this->repository->get($filter);
    }
}
