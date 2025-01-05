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
    public function get__キャンプ場のエンティティのリストを取得できる(): void
    {
        $models_camp_ground = ModelsCampGround::create([
            'name' => 'テストオートキャンプ場',
            'address' => 'テスト県テスト市テスト町000',
            'price' => 1000,
            'image_url' => 'https://example.com/test.jpg',
            'elevation' => 1000,
        ]);
        $statuses = Status::factory()
            ->count(3)
            ->sequence(
                ['name' => 'draft'],
                ['name' => 'published'],
                ['name' => 'archived']
            )->create();
        $locations = Location::factory()->count(6)->sequence(
            ['name' => 'sea'],
            ['name' => 'mountain'],
            ['name' => 'river'],
            ['name' => 'lake'],
            ['name' => 'woods'],
            ['name' => 'highland']
        )->create();
        $models_camp_ground->statuses()->attach($statuses[1]->id);
        $models_camp_ground->locations()->attach($locations[1]->id);
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
}
