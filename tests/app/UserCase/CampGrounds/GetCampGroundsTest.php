<?php

namespace Tests\App\UseCase\CampGrounds;

use App\Domain\Models\CampGrounds\CampGround;
use App\Domain\Models\CampGrounds\CampGroundAddress;
use App\Domain\Models\CampGrounds\CampGroundId;
use App\Domain\Models\CampGrounds\CampGroundImage;
use App\Domain\Models\CampGrounds\CampGroundName;
use App\Domain\Models\CampGrounds\CampGroundPrice;
use App\Domain\Models\CampGrounds\CampGroundStatus;
use App\UseCase\CampGrounds\GetCampGrounds;
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

        $use_case = new GetCampGrounds();

        $this->assertEquals($camp_grounds, $use_case->execute());
    }
}
