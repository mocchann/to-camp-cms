<?php

namespace App\Domain\Models\Users;

use App\Domain\Users\User;

interface IUserRepository
{
    public function findById(UserId $id): ?User;
    public function register(UserId $id, UserName $name, UserEmail $email, UserPassword $password): void;
}
