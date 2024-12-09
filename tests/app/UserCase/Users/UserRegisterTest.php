<?php

namespace Tests\App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;
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
        $repository->shouldReceive('findByEmail')
            ->andReturn(null);

        $repository->shouldReceive('save')
            ->andReturnUsing(function (User $user) {
                ModelsUser::create([
                    'id' => $user->getId()->getValue(),
                    'name' => $user->getName()->getValue(),
                    'email' => $user->getEmail()->getValue(),
                    'password' => $user->getPassword()->getValue()
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

    #[Test]
    public function 同じユーザーは登録できない(): void
    {
        $repository = Mockery::mock(IUserRepository::class);
        $repository->shouldReceive('findByEmail')
            ->andReturn(new User(
                new UserId(1),
                new UserName('test_user'),
                new UserEmail('test_user@example.com'),
                new UserPassword('password')
            ));
        $repository->shouldReceive('save')
            ->andReturnUsing(function (User $user) {
                ModelsUser::create([
                    'id' => $user->getId()->getValue(),
                    'name' => $user->getName()->getValue(),
                    'email' => $user->getEmail()->getValue(),
                    'password' => $user->getPassword()->getValue()
                ]);
            });

        /**
         * @var IUserRepository $repository
         */
        $service = new UserService($repository);
        $use_case = new UserRegister($service, $repository);

        $id = 2;
        $name = 'test_user';
        $email = 'test_user@example.com';
        $password = 'password';

        $use_case->execute($id, $name, $email, $password);

        $this->assertDatabaseCount('users', 0);
    }
}
