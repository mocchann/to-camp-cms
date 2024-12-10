<?php

namespace App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserPassword;

class UserLogin
{
    public function __construct(private IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(
        string $email,
        string $password
    ): bool {
        $user_email = new UserEmail($email);
        $user_password = new UserPassword($password);

        $user = $this->repository->findByEmail($user_email);

        if (is_null($user)) {
            return false;
        }

        if ($user->getEmail()->getValue() === $user_email->getValue() && $user->getPassword()->getValue() === $user_password->getValue()) {
            return true;
        }

        return false;
    }
}
