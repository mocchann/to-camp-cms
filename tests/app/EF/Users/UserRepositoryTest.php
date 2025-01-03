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
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function FindById__ユーザーのエンティティを取得できる(): void
    {
        $password = Hash::make('password');
        $models_user = ModelsUser::create([
            'name' => 'test_user',
            'email' => 'https://example.com',
            'password' => $password
        ]);
        $expected = new User(
            new UserId($models_user->id),
            new UserName('test_user'),
            new UserEmail('https://example.com'),
            new UserPassword($password)
        );
        $repository = new UserRepository();

        $user = $repository->findById(new UserId($models_user->id));

        $this->assertEquals($expected, $user);
    }

    #[Test]
    public function FindByEmail(): void
    {
        $this->assertTrue(true);
    }

    #[Test]
    public function Save(): void
    {
        $this->assertTrue(true);
    }
}
