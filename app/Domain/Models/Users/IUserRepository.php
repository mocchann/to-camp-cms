<?php

namespace App\Domain\Models\Users;

use App\Domain\Users\User;

interface IUserRepository
{
    public function findById(UserId $id): ?User;
}
