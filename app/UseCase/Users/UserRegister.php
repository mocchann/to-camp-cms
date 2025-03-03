<?php

namespace App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\User;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;
use App\Domain\Models\Users\UserPassword;
use App\Domain\Models\Users\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserRegister
{
    public function __construct(
        private UserService $user_service,
        private IUserRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function execute(
        int $id,
        string $name,
        string $email,
        string $password
    ) {
        $user_id = new UserId($id);
        $user_name = new UserName($name);
        $user_email = new UserEmail($email);
        $user_password = new UserPassword($password);
        $user = new User($user_id, $user_name, $user_email, $user_password);

        if ($this->user_service->exists($user)) {
            Log::info('User already exists');

            return false;
        }

        $this->repository->save($user);

        Auth::login($user);

        return $user;
    }
}
