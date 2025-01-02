<?php

namespace App\EF\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\User;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;

class UserRepository implements IUserRepository
{
    public function findById(UserId $id): ?User
    {
        return null;
    }

    public function findByEmail(UserEmail $id): ?User
    {
        return null;
    }

    public function save(User $user): void {}
}
