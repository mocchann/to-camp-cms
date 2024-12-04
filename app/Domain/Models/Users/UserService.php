<?php

namespace App\Domain\Models\Users;

use App\Domain\Users\User;

class UserService
{
    public function __construct(private IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function exists(User $user): bool
    {
        return $this->repository->findById($user->getId()) !== null;
    }
}
