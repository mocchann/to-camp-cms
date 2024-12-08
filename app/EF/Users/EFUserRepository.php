<?php

namespace App\Domain\Models\Users;

use App\Domain\Users\User;

class UserRepository implements IUserRepository
{
    public function findById(UserId $id): ?User
    {
        // TODO: Implement findById() method.
    }

    public function register(UserId $id, UserName $name, UserEmail $email, UserPassword $password): void
    {
        // TODO: Implement register() method.
    }
}
