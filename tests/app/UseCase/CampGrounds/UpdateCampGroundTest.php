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
use App\UseCase\CampGrounds\UpdateCampGround;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateCampGroundTest extends TestCase
{
    #[Test]
    public function キャンプ場情報を更新できる(): void
    {
        $expected = new CampGround(
            new CampGroundId(1),
            new CampGroundName('テストオートキャンプ場'),
            new CampGroundAddress('沖縄県晴海町1-12-89'),
            new CampGroundPrice(2000),
            new CampGroundImage('https://example.com/image.jpg'),
            new CampGroundStatus('open')
        );

        $repository = Mockery::mock(ICampGroundRepository::class);
        $repository->shouldReceive('save')->andReturn($expected);
        $repository->shouldReceive('update')->andReturn($expected);

        /** @var ICampGroundRepository $repository */
        $register_use_case = new RegisterCampGround($repository);

        /** @var ICampGroundRepository $repository */
        $update_use_case = new UpdateCampGround($repository);

        $register_use_case->execute(1, 'テストオートキャンプ場', '沖縄県晴海町1-12-89', 3000, 'https://example.com/image.jpg', 'close');
        $actual = $update_use_case->execute(1, 'テストオートキャンプ場', '沖縄県晴海町1-12-89', 2000, 'https://example.com/image.jpg', 'open');

        $this->assertEquals($expected, $actual);
    }
}
