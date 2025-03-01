<?php

namespace App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserPassword;
use Illuminate\Support\Facades\Auth;

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

        return Auth::attempt([
            'email' => $user_email->getValue(),
            'password' => $user_password->getValue(),
        ]);
    }
}
