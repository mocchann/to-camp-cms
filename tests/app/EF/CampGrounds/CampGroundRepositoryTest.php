<?php

namespace Tests\App\EF\CampGrounds;

use App\Domain\Models\CampGrounds\CampGround;
use App\Domain\Models\CampGrounds\CampGroundAddress;
use App\Domain\Models\CampGrounds\CampGroundElevation;
use App\Domain\Models\CampGrounds\CampGroundId;
use App\Domain\Models\CampGrounds\CampGroundImage;
use App\Domain\Models\CampGrounds\CampGroundLocation;
use App\Domain\Models\CampGrounds\CampGroundName;
use App\Domain\Models\CampGrounds\CampGroundPrice;
use App\Domain\Models\CampGrounds\CampGroundStatus;
use App\Domain\Models\CampGrounds\GetCampGroundsFilter;
use App\EF\CampGrounds\CampGroundRepository;
use App\Models\CampGround as ModelsCampGround;
use App\Models\Location;
use App\Models\Status;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CampGroundRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function get__キャンプ場のリストを取得できる(): void
    {
        $models_camp_ground = ModelsCampGround::factory()
            ->has(Status::factory()->state(['name' => 'published']))
            ->has(Location::factory()->state(['name' => 'mountain']))
            ->create([
                'name' => 'テストオートキャンプ場',
                'address' => 'テスト県テスト市テスト町000',
                'price' => 1000,
                'image_url' => 'https://example.com/test.jpg',
                'elevation' => 1000,
            ]);
        $repository = new CampGroundRepository();
        $filter = new GetCampGroundsFilter();

        $this->assertEquals(
            [
                new CampGround(
                    new CampGroundId($models_camp_ground->id),
                    new CampGroundName('テストオートキャンプ場'),
                    new CampGroundAddress('テスト県テスト市テスト町000'),
                    new CampGroundPrice(1000),
                    new CampGroundImage('https://example.com/test.jpg'),
                    new CampGroundStatus('published'),
                    new CampGroundLocation('mountain'),
                    new CampGroundElevation(1000)
                ),
            ],
            $repository->get($filter)
        );
    }

    #[Test]
    public function findById__idからキャンプ場を取得できる(): void
    {
        $models_camp_ground = ModelsCampGround::factory()
            ->has(Status::factory()->state(['name' => 'published']))
            ->has(Location::factory()->state(['name' => 'mountain']))
            ->create([
                'name' => 'テストオートキャンプ場',
                'address' => 'テスト県テスト市テスト町000',
                'price' => 1000,
                'image_url' => 'https://example.com/test.jpg',
                'elevation' => 1000,
            ]);
        $repository = new CampGroundRepository();

        $this->assertEquals(
            new CampGround(
                new CampGroundId($models_camp_ground->id),
                new CampGroundName('テストオートキャンプ場'),
                new CampGroundAddress('テスト県テスト市テスト町000'),
                new CampGroundPrice(1000),
                new CampGroundImage('https://example.com/test.jpg'),
                new CampGroundStatus('published'),
                new CampGroundLocation('mountain'),
                new CampGroundElevation(1000)
            ),
            $repository->findById(new CampGroundId($models_camp_ground->id))
        );
    }
}
