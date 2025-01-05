<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampGround>
 */
class CampGroundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ja_JP');

        return [
            'name' => $faker->streetName() . 'オートキャンプ場',
            'address' => $faker->address(),
            'price' => $faker->numberBetween(1000, 10000),
            'image_url' => $faker->imageUrl(),
            'elevation' => $faker->numberBetween(0, 2000),
        ];
    }
}
