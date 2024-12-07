<?php

namespace App\Domain\Models\Users;

interface IUserRepository
{
    public function findById(UserId $id): ?User;
    public function register(UserId $id, UserName $name, UserEmail $email, UserPassword $password): void;
}
