<?php

namespace App\Repositories\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\User;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;
use App\Domain\Models\Users\UserPassword;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;

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

    public function save(User $user): void
    {
        $models_user = new ModelsUser;
        $models_user->id = $user->getId()->getValue();
        $models_user->name = $user->getName()->getValue();
        $models_user->email = $user->getEmail()->getValue();
        $models_user->password = $user->getPassword()->getValue();
        $models_user->save();
    }

    public function delete(): void
    {
        $user_id = Auth::user()->id;

        $models_user = ModelsUser::find($user_id);

        $models_user->delete();
    }
}
