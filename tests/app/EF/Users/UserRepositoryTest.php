<?php

namespace Tests\App\EF\Users;

use App\Domain\Models\Users\User;
use App\Domain\Models\Users\UserEmail;
use App\Domain\Models\Users\UserId;
use App\Domain\Models\Users\UserName;
use App\Domain\Models\Users\UserPassword;
use App\EF\Users\UserRepository;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\AssignOp\Mod;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function FindById__idからユーザーのエンティティを取得できる(): void
    {
        $password = Hash::make('password');
        $models_user = ModelsUser::create([
            'name' => 'test_user',
            'email' => 'test_user@example.com',
            'password' => $password
        ]);
        $expected = new User(
            new UserId($models_user->id),
            new UserName('test_user'),
            new UserEmail('test_user@example.com'),
            new UserPassword($password)
        );
        $repository = new UserRepository();

        $user = $repository->findById(new UserId($models_user->id));

        $this->assertEquals($expected, $user);
    }

    #[Test]
    public function FindByEmail__emailからユーザーのエンティティを取得できる(): void
    {
        $password = Hash::make('password');
        $models_user = ModelsUser::create([
            'name' => 'test_user',
            'email' => 'test_user@example.com',
            'password' => $password
        ]);
        $expected = new User(
            new UserId($models_user->id),
            new UserName('test_user'),
            new UserEmail('test_user@example.com'),
            new UserPassword($password)
        );
        $repository = new UserRepository();

        $user = $repository->findByEmail(new UserEmail('test_user@example.com'));

        $this->assertEquals($expected, $user);
    }

    #[Test]
    public function save__ユーザーを登録できる(): void
    {
        $password = Hash::make('password');
        $repository = new UserRepository();

        $repository->save(new User(
            new UserId(1),
            new UserName('test_user'),
            new UserEmail('test_user@example.com'),
            new UserPassword($password)
        ));

        $this->assertDatabaseHas('users', [
            'id' => 1,
            'name' => 'test_user',
            'email' => 'test_user@example.com',
            'password' => $password
        ]);
    }
}
