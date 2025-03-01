<?php

namespace App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\UserId;
use Illuminate\Support\Facades\Auth;

class UserDelete
{
    public function __construct(private IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): void
    {
        $id = new UserId(Auth::user()->id);

        $this->repository->delete($id);
    }
}
