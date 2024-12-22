<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\CampGround;
use App\Domain\Models\CampGrounds\ICampGroundRepository;

class RegisterCampGround
{
    public function __construct(
        private ICampGroundRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function execute(
        int $id,
        string $name,
        string $address,
        int $price,
        string $image,
        string $status
    ): CampGround {
        $command = new RegisterCampGroundCommand(
            $id,
            $name,
            $address,
            $price,
            $image,
            $status
        );

        return $this->repository->save($command);
    }
}
