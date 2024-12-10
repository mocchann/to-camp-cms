<?php

namespace App\Domain\Models\Users;

use App\Domain\Users\User;

class UserRepository implements IUserRepository
{
    public function findById(UserId $id): ?User
    {
        // TODO: Implement findById() method.
    }

    public function findByEmail(UserEmail $id): ?User
    {
        // TODO: Implement findByEmail() method.
    }

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }
}
