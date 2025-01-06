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

    #[Test]
    public function findById__存在しないidの場合nullを返す(): void
    {
        $repository = new CampGroundRepository();

        $this->assertNull($repository->findById(new CampGroundId(999999)));
    }

    #[Test]
    public function update__キャンプ場情報を更新できる(): void
    {
        $statuses = Status::factory()->sequence(
            ['name' => 'draft'],
            ['name' => 'published'],
            ['name' => 'archived']
        )->create();
        $locations = Location::factory()->sequence(
            ['name' => 'sea'],
            ['name' => 'mountain'],
            ['name' => 'river']
        )->create();
        $models_camp_ground = ModelsCampGround::factory()
        // todo: この処理でうまく中間テーブルを使ったリレーションが登録できてないので修正する
            ->afterCreating(function ($camp_ground) use ($statuses) {
                $camp_ground->statuses()->attach($statuses[0]);
            })
            ->afterCreating(function ($camp_ground) use ($locations) {
                $camp_ground->locations()->attach($locations[0]);
            })
            ->create([
                'name' => 'テストオートキャンプ場',
                'address' => 'テスト県テスト市テスト町000',
                'price' => 1000,
                'image_url' => 'https://example.com/test.jpg',
                'elevation' => 1000,
            ]);
        $repository = new CampGroundRepository();

        $repository->update(
            new CampGround(
                new CampGroundId($models_camp_ground->id),
                new CampGroundName('更新後オートキャンプ場'),
                new CampGroundAddress('更新後県更新後市更新後町000'),
                new CampGroundPrice(2000),
                new CampGroundImage('https://example.com/update.jpg'),
                new CampGroundStatus('published'),
                new CampGroundLocation('mountain'),
                new CampGroundElevation(2000)
            )
        );

        $this->assertDatabaseHas('camp_grounds', [
            'id' => $models_camp_ground->id,
            'name' => '更新後オートキャンプ場',
            'address' => '更新後県更新後市更新後町000',
            'price' => 2000,
            'image_url' => 'https://example.com/update.jpg',
            'elevation' => 2000,
        ]);
        $this->assertDatabaseHas('camp_ground_status', [
            'camp_ground_id' => $models_camp_ground->id,
            'status_id' => Status::where('name', 'published')->first()->id,
        ]);
    }
}
