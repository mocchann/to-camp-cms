<?php

namespace Tests\App\UseCase\CampGrounds;

use App\UseCase\CampGrounds\RegisterCampGrounds;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegisterCampGroundsTest extends TestCase
{
    #[Test]
    public function キャンプ場情報を登録できる(): void
    {
        $use_case = new RegisterCampGrounds();

        $this->assertInstanceOf(RegisterCampGrounds::class, $use_case);
    }
}
