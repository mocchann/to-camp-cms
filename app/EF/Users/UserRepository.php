<?php

namespace App\EF\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\User;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;
use App\Domain\Models\Users\UserPassword;
use App\Models\User as ModelsUser;

class UserRepository implements IUserRepository
{
    public function findById(UserId $id): ?User
    {
        $user = ModelsUser::find($id->getValue());
        if (is_null($user)) {
            return null;
        }

        return new User(
            new UserId($user->id),
            new UserName($user->name),
            new UserEmail($user->email),
            new UserPassword($user->password)
        );
    }

    public function findByEmail(UserEmail $email): ?User
    {
        $user = ModelsUser::where('email', $email->getValue())->first();
        if (is_null($user)) {
            return null;
        }

        return new User(
            new UserId($user->id),
            new UserName($user->name),
            new UserEmail($user->email),
            new UserPassword($user->password)
        );
    }

    public function save(User $user): void {}
}
