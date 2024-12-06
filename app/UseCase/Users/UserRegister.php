<?php

namespace App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;
use App\Domain\Models\Users\UserPassword;
use App\Domain\Models\Users\UserService;
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
    ): void {
        $user_id = new UserId($id);
        $user = $this->repository->findById($user_id);

        if ($this->user_service->exists($user)) {
            Log::info('User already exists');
            return;
        }

        $user_name = new UserName($name);
        $user_email = new UserEmail($email);
        $user_password = new UserPassword($password);

        $this->repository->register($user_id, $user_name, $user_email, $user_password);
    }
}
