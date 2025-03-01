<?php

namespace App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;

class UserDelete
{
    public function __construct(private IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): void
    {
        $this->repository->delete();
    }
}
