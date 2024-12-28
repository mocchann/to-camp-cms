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
use App\UseCase\CampGrounds\UpdateCampGroundCommand;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateCampGroundTest extends TestCase
{
    #[Test]
    public function キャンプ情報を登録できる(): void
    {
        $camp_ground = new CampGround(
            new CampGroundId(1),
            new CampGroundName('テストオートキャンプ場'),
            new CampGroundAddress('沖縄県晴海町1-12-89'),
            new CampGroundPrice(3000),
            new CampGroundImage('https://example.com/image.jpg'),
            new CampGroundStatus('close')
        );
        $repository = Mockery::mock(ICampGroundRepository::class);
        $repository->shouldReceive('update')->andReturn($camp_ground);
        /** @var ICampGroundRepository $repository */
        $use_case = new UpdateCampGround($repository);
        $command = new UpdateCampGroundCommand(
            1,
            'テストオートキャンプ場',
            '沖縄県晴海町1-12-89',
            3000,
            'https://example.com/image.jpg',
            'close'
        );
        $result = $use_case->execute($command);

        $this->assertEquals([
            'id' => 1,
            'name' => 'テストオートキャンプ場',
            'address' => '沖縄県晴海町1-12-89',
            'price' => 3000,
            'image' => 'https://example.com/image.jpg',
            'status' => 'close',
        ], [
            'id' => $result->getId()->getValue(),
            'name' => $result->getName()->getValue(),
            'address' => $result->getAddress()->getValue(),
            'price' => $result->getPrice()->getValue(),
            'image' => $result->getImage()->getValue(),
            'status' => $result->getStatus()->getValue(),
        ]);
    }

    #[Test]
    public function キャンプ場情報を更新できる(): void
    {
        $initial_camp_ground = new CampGround(
            new CampGroundId(1),
            new CampGroundName('テストオートキャンプ場'),
            new CampGroundAddress('沖縄県晴海町1-12-89'),
            new CampGroundPrice(3000),
            new CampGroundImage('https://example.com/image.jpg'),
            new CampGroundStatus('close')
        );
        $updated_camp_ground = new CampGround(
            new CampGroundId(1),
            new CampGroundName('テストオートキャンプ場'),
            new CampGroundAddress('沖縄県晴海町1-12-89'),
            new CampGroundPrice(2000),
            new CampGroundImage('https://example.com/image.jpg'),
            new CampGroundStatus('open')
        );
        $repository = Mockery::mock(ICampGroundRepository::class);
        $repository->shouldReceive('save')->andReturn($initial_camp_ground);
        $repository->shouldReceive('update')->andReturn($updated_camp_ground);
        /** @var ICampGroundRepository $repository */
        $use_case = new UpdateCampGround($repository);
        $initial_command = new UpdateCampGroundCommand(
            1,
            'テストオートキャンプ場',
            '沖縄県晴海町1-12-89',
            3000,
            'https://example.com/image.jpg',
            'close'
        );
        $update_command = new UpdateCampGroundCommand(
            1,
            'テストオートキャンプ場',
            '沖縄県晴海町1-12-89',
            2000,
            'https://example.com/image.jpg',
            'open'
        );
        $use_case->execute($initial_command);
        $result = $use_case->execute($update_command);

        $this->assertEquals([
            'id' => 1,
            'name' => 'テストオートキャンプ場',
            'address' => '沖縄県晴海町1-12-89',
            'price' => 2000,
            'image' => 'https://example.com/image.jpg',
            'status' => 'open',
        ], [
            'id' => $result->getId()->getValue(),
            'name' => $result->getName()->getValue(),
            'address' => $result->getAddress()->getValue(),
            'price' => $result->getPrice()->getValue(),
            'image' => $result->getImage()->getValue(),
            'status' => $result->getStatus()->getValue(),
        ]);
    }
}
