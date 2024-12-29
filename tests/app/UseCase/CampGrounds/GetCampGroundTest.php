<?php

namespace Tests\App\UseCase\CampGrounds;

use App\Domain\Enums\CampGroundStatus as EnumsCampGroundStatus;
use App\Domain\Models\CampGrounds\CampGround;
use App\Domain\Models\CampGrounds\CampGroundAddress;
use App\Domain\Models\CampGrounds\CampGroundId;
use App\Domain\Models\CampGrounds\CampGroundImage;
use App\Domain\Models\CampGrounds\CampGroundName;
use App\Domain\Models\CampGrounds\CampGroundPrice;
use App\Domain\Models\CampGrounds\CampGroundStatus;
use App\Domain\Models\CampGrounds\ICampGroundRepository;
use App\UseCase\CampGrounds\GetCampGround;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetCampGroundTest extends TestCase
{
    #[Test]
    public function キャンプ場情報を取得できる()
    {
        $camp_ground = new CampGround(
            new CampGroundId(1),
            new CampGroundName('テストオートキャンプ場'),
            new CampGroundAddress('沖縄県晴海町1-12-89'),
            new CampGroundPrice(3000),
            new CampGroundImage('https://example.com/image.jpg'),
            new CampGroundStatus(EnumsCampGroundStatus::PUBLISHED),
        );
        $repository = Mockery::mock(ICampGroundRepository::class);
        $repository->shouldReceive('findById')->andReturn($camp_ground);
        /** @var ICampGroundRepository $repository */
        $use_case = new GetCampGround($repository);

        $result = $use_case->execute(1);

        $this->assertEquals(
            [
                'id' => 1,
                'name' => 'テストオートキャンプ場',
                'address' => '沖縄県晴海町1-12-89',
                'price' => 3000,
                'image' => 'https://example.com/image.jpg',
                'status' => '公開',
            ],
            [
                'id' => $result->getId()->getValue(),
                'name' => $result->getName()->getValue(),
                'address' => $result->getAddress()->getValue(),
                'price' => $result->getPrice()->getValue(),
                'image' => $result->getImage()->getValue(),
                'status' => $result->getStatus()->getValue()->status(),
            ]
        );
    }
}
