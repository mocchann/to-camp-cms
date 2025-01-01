<?php

namespace Tests\App\UseCase\Users;

use App\Domain\Models\Users\IUserRepository;
use App\Domain\Models\Users\UserService;
use App\Domain\Models\Users\User;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;
use App\Domain\Models\Users\UserPassword;
use App\Models\User as ModelsUser;
use App\UseCase\Users\UserRegister;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
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
                    'password' => Hash::make($user->getPassword()->getValue())
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

        $this->assertDatabaseHas('users', [
            'name' => 'test_user'
        ]);
    }

    #[Test]
    public function 同じemailのユーザーは登録できない(): void
    {
        $models_user = ModelsUser::create([
            'name' => 'test_user',
            'email' => 'test_user@example.com',
            'password' => Hash::make('password')
        ]);
        $user = new User(
            new UserId($models_user->id),
            new UserName($models_user->name),
            new UserEmail($models_user->email),
            new UserPassword($models_user->password)
        );
        $repository = Mockery::mock(IUserRepository::class);
        $repository->shouldReceive('findByEmail')
            ->andReturn($user);
        $repository->shouldReceive('save')
            ->andReturnUsing(function (User $user) {
                ModelsUser::create([
                    'id' => $user->getId()->getValue(),
                    'name' => $user->getName()->getValue(),
                    'email' => $user->getEmail()->getValue(),
                    'password' => Hash::make($user->getPassword()->getValue())
                ]);
            });
        /**
         * @var IUserRepository $repository
         */
        $service = new UserService($repository);
        $use_case = new UserRegister($service, $repository);
        $id = 2;
        $name = 'test_user2';
        $email = 'test_user@example.com';
        $password = 'password2';

        $use_case->execute($id, $name, $email, $password);

        $this->assertDatabaseMissing('users', [
            'name' => 'test_user2'
        ]);
    }
}
