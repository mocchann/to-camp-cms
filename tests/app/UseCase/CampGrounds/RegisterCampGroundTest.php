<?php

namespace Tests\App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\CampGround;
use App\Domain\Models\CampGrounds\CampGroundAddress;
use App\Domain\Models\CampGrounds\CampGroundId;
use App\Domain\Models\CampGrounds\CampGroundImage;
use App\Domain\Models\CampGrounds\CampGroundName;
use App\Domain\Models\CampGrounds\CampGroundPrice;
use App\Domain\Models\CampGrounds\CampGroundStatus;
use App\Domain\Models\CampGrounds\ICampGroundRepository;
use App\UseCase\CampGrounds\RegisterCampGround;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegisterCampGroundTest extends TestCase
{
    #[Test]
    public function キャンプ場情報を新規登録できる(): void
    {
        $expected = new CampGround(
            new CampGroundId(1),
            new CampGroundName('テストオートキャンプ場'),
            new CampGroundAddress('沖縄県晴海町1-12-89'),
            new CampGroundPrice(3000),
            new CampGroundImage('https://example.com/image.jpg'),
            new CampGroundStatus('open')
        );

        $repository = Mockery::mock(ICampGroundRepository::class);
        $repository->shouldReceive('save')->andReturn($expected);

        /** @var ICampGroundRepository $repository */
        $use_case = new RegisterCampGround($repository);

        $actual = $use_case->execute(
            1,
            'テストオートキャンプ場',
            '沖縄県晴海町1-12-89',
            3000,
            'https://example.com/image.jpg',
            'open'
        );

        $this->assertEquals($expected, $actual);
    }
}
