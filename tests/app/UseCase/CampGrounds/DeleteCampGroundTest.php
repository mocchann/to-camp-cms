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
use App\UseCase\CampGrounds\DeleteCampGround;
use App\UseCase\CampGrounds\GetCampGround;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteCampGroundTest extends TestCase
{
    #[Test]
    public function キャンプ場情報を削除できる()
    {
        $camp_ground = new CampGround(
            new CampGroundId(1),
            new CampGroundName('テストオートキャンプ場'),
            new CampGroundAddress('沖縄県晴海町1-12-89'),
            new CampGroundPrice(3000),
            new CampGroundImage('https://example.com/image.jpg'),
            new CampGroundStatus('open'),
        );
        $repository = Mockery::mock(ICampGroundRepository::class);
        $repository->shouldReceive('save')->andReturn($camp_ground);
        $repository->shouldReceive('delete')->andReturnUndefined();
        $repository->shouldReceive('find')->andReturn(null);

        /** @var ICampGroundRepository $repository */
        $delete_use_case = new DeleteCampGround($repository);
        $delete_use_case->execute(1);
        $get_use_case = new GetCampGround($repository);

        $this->assertNull($get_use_case->execute(1));
    }
}
