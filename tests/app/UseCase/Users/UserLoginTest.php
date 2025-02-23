<?php

namespace Tests\App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\User;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;
use App\Domain\Models\Users\UserPassword;
use App\UseCase\Users\UserLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    #[Test]
    public function ユーザーがログインできる(): void
    {
        $user = new User(
            new UserId(1),
            new UserName('test_user'),
            new UserEmail('test_user@example.com'),
            new UserPassword('password')
        );
        Auth::shouldReceive('attempt')
            ->once()
            ->with([
                'email' => 'test_user@example.com',
                'password' => 'password'
            ])
            ->andReturn(true);
        $repository = Mockery::mock(IUserRepository::class);
        $repository->shouldReceive('findByEmail')
            ->andReturnUsing(function () use ($user) {
                return $user;
            });

        /**
         * @var IUserRepository $repository
         */
        $use_case = new UserLogin($repository);

        $this->assertTrue($use_case->execute('test_user@example.com', 'password'));
    }
}
