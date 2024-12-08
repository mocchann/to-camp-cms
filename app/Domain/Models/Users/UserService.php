<?php

namespace App\Domain\Models\Users;

class UserService
{
    public function __construct(private IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function exists(User $user): bool
    {
        return $this->repository->findByEmail($user->getEmail()) !== null;
    }
}
