<?php

namespace Tests\App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;
use App\Domain\Models\Users\UserPassword;
use App\Domain\Models\Users\UserService;
use App\Domain\Models\Users\User;
use App\Models\User as ModelsUser;
use App\UseCase\Users\UserRegister;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function ユーザーを登録できる(): void
    {
        $repository = Mockery::mock(IUserRepository::class);
        $repository->shouldReceive('findById')
            ->andReturn(null, new User(
                new UserId(1),
                new UserName('test_user'),
                new UserEmail('test_user@example.com'),
                new UserPassword('password')
            ));

        $repository->shouldReceive('register')
            ->andReturnUsing(function (UserId $id, UserName $name, UserEmail $email, UserPassword $password) {
                ModelsUser::create([
                    'id' => $id->getId(),
                    'name' => $name->getName(),
                    'email' => $email->getEmail(),
                    'password' => $password->getPassword()
                ]);
            });

        /**
         * @var IUserRepository $repository
         */
        $service = new UserService($repository);
        $use_case = new UserRegister($service, $repository);

        $id = 1;
        $name = 'test_user';
        $email = 'test_user@example.com';
        $password = 'password';

        $use_case->execute($id, $name, $email, $password);

        $this->assertDatabaseCount('users', 1);
    }
}
