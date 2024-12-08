<?php

namespace App\Domain\Models\Users;

interface IUserRepository
{
    public function findById(UserId $id): ?User;
    public function findByEmail(UserEmail $id): ?User;
    public function save(User $user): void;
}
