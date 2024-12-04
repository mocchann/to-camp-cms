<?php

namespace App\Domain\Models\Users;

use App\Domain\Users\User;

interface IUserRepository
{
    public function findById(UserId $id): ?User;
    public function register(int $id, string $name, string $email, string $password): void;
}
