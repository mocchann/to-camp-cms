<?php

namespace Tests\App\Http\Requests;

use App\Http\Requests\UpdateCampGroundRequest;
use App\Models\CampGround;
use App\Models\Location;
use App\Models\Status;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateCampGroundRequestTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    #[DataProvider('updateCampGroundDataProvider')]
    public function キャンプ場更新のバリデーションテスト(array $values, bool $expected)
    {
        Status::factory()
            ->count(3)
            ->sequence(
                ['name' => 'draft'],
                ['name' => 'published'],
                ['name' => 'archived']
            )->create();
        Location::factory()
            ->count(3)
            ->sequence(
                ['name' => 'sea'],
                ['name' => 'mountain'],
                ['name' => 'river']
            )->create();
        CampGround::factory()->create([
            'id' => '01F8MECHZX3TBDSZ7XRADM79XE',
            'name' => 'name',
            'address' => '123 camp field',
            'price' => 1000,
            'image_url' => 'images/test.png',
            'elevation' => 100,
        ]);
        CampGround::factory()->create([
            'id' => '01F8MECHZX3TBDSZ7XRADM79XF',
            'name' => 'other name',
            'address' => '124 camp field',
            'price' => 1000,
            'image_url' => 'images/test.png',
            'elevation' => 1000,
        ]);
        $request = new UpdateCampGroundRequest;
        $request->merge($values);
        $rules = $request->rules();
        $validator = Validator::make($request->all(), $rules);

        $this->assertEquals($expected, $validator->passes());
    }

    public function updateCampGroundDataProvider(): array
    {
        $image_file = UploadedFile::fake()->create('test.png', 100, 'image/png');

        return [
            'キャンプ場データを更新するとき、自身のキャンプ場名での更新はvalid' => [
                'values' => [
                    'id' => '01F8MECHZX3TBDSZ7XRADM79XE',
                    'name' => 'name',
                    'address' => 'address',
                    'price' => 1000,
                    'image' => $image_file,
                    'status' => 'published',
                    'location' => 'river',
                    'elevation' => 10,
                ],
                'expected' => true,
            ],
            'キャンプ場データを更新するとき、他のキャンプ場名と同じ名前での更新はinvalid' => [
                'values' => [
                    'id' => '01F8MECHZX3TBDSZ7XRADM79XE',
                    'name' => 'other name',
                    'address' => 'address',
                    'price' => 10000,
                    'image' => $image_file,
                    'status' => 'published',
                    'location' => 'river',
                    'elevation' => 10,
                ],
                'expected' => false,
            ],
        ];
    }
}
