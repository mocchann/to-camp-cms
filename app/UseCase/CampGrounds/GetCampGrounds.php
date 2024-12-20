<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\ICampGroundRepository;

class GetCampGrounds
{
    public function __construct(private ICampGroundRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(
        ?int $id = null,
        ?string $name = null,
        ?string $address = null,
        ?int $price = null,
        ?string $image = null,
        ?string $status = null
    ): array {
        $command = new GetCampGroundsCommand(
            $id,
            $name,
            $address,
            $price,
            $image,
            $status
        );

        $camp_grounds = $this->repository->get($command);

        return $camp_grounds;
    }
}
