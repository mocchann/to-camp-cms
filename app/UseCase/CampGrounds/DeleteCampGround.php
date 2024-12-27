<?php

namespace App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\ICampGroundRepository;

class DeleteCampGround
{
    public function __construct(private ICampGroundRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): void
    {
        $this->repository->delete($id);
    }
}
