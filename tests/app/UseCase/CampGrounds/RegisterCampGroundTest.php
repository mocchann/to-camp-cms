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
        $camp_ground = new CampGround(
            new CampGroundId(1),
            new CampGroundName('テストオートキャンプ場'),
            new CampGroundAddress('沖縄県晴海町1-12-89'),
            new CampGroundPrice(3000),
            new CampGroundImage('https://example.com/image.jpg'),
            new CampGroundStatus('open')
        );

        $repository = Mockery::mock(ICampGroundRepository::class);
        $repository->shouldReceive('save')->andReturn($camp_ground);

        /** @var ICampGroundRepository $repository */
        $use_case = new RegisterCampGround($repository);

        $result = $use_case->execute(
            1,
            'テストオートキャンプ場',
            '沖縄県晴海町1-12-89',
            3000,
            'https://example.com/image.jpg',
            'open'
        );

        $this->assertEquals(
            [
                'id' => 1,
                'name' => 'テストオートキャンプ場',
                'address' => '沖縄県晴海町1-12-89',
                'price' => 3000,
                'image' => 'https://example.com/image.jpg',
                'status' => 'open',
            ],
            [
                'id' => $camp_ground->getId()->getValue(),
                'name' => $camp_ground->getName()->getValue(),
                'address' => $camp_ground->getAddress()->getValue(),
                'price' => $camp_ground->getPrice()->getValue(),
                'image' => $camp_ground->getImage()->getValue(),
                'status' => $camp_ground->getStatus()->getValue(),
            ],
        );
    }
}
