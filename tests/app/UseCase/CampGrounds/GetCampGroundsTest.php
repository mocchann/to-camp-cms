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
use App\UseCase\CampGrounds\GetCampGrounds;
use App\UseCase\CampGrounds\GetCampGroundsCommand;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetCampGroundsTest extends TestCase
{
    #[Test]
    public function キャンプ場一覧を取得できる(): void
    {
        $camp_grounds = [
            new CampGround(
                new CampGroundId(1),
                new CampGroundName('テストオートキャンプ場'),
                new CampGroundAddress('沖縄県晴海町1-12-89'),
                new CampGroundPrice(3000),
                new CampGroundImage('https://example.com/image.jpg'),
                new CampGroundStatus('open'),
            ),
            new CampGround(
                new CampGroundId(2),
                new CampGroundName('テストキャンプ場'),
                new CampGroundAddress('北海道青天町807'),
                new CampGroundPrice(5000),
                new CampGroundImage('https://example.com/image.jpg'),
                new CampGroundStatus('open'),
            ),
        ];
        $command = new GetCampGroundsCommand(
            null,
            null,
            null,
            null,
            null,
            null
        );
        $repository = Mockery::mock(ICampGroundRepository::class);
        $repository->shouldReceive('get')->andReturn($camp_grounds);
        /** @var ICampGroundRepository $repository */
        $use_case = new GetCampGrounds($repository);

        $result = $use_case->execute($command);

        $this->assertEquals(
            [
                [
                    'id' => 1,
                    'name' => 'テストオートキャンプ場',
                    'address' => '沖縄県晴海町1-12-89',
                    'price' => 3000,
                    'image' => 'https://example.com/image.jpg',
                    'status' => 'open',
                ],
                [
                    'id' => 2,
                    'name' => 'テストキャンプ場',
                    'address' => '北海道青天町807',
                    'price' => 5000,
                    'image' => 'https://example.com/image.jpg',
                    'status' => 'open',
                ],
            ],
            array_map(fn(CampGround $camp_ground) =>
            [
                'id' => $camp_ground->getId()->getValue(),
                'name' => $camp_ground->getName()->getValue(),
                'address' => $camp_ground->getAddress()->getValue(),
                'price' => $camp_ground->getPrice()->getValue(),
                'image' => $camp_ground->getImage()->getValue(),
                'status' => $camp_ground->getStatus()->getValue(),
            ], $result)
        );
    }
}
