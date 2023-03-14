<?php

namespace Database\Factories;

use App\Models\Builder;
use App\Models\Housing;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Комплекс: "' . $this->faker->word(2) . '"',
            'builder_id' => Builder::get()->random()->id,
            'housing_id' => Housing::get()->random()->id,
            'image_preview' => '1.jpg',
            'metro_distance' => random_int(1, 60),
            'address' => $this->faker->streetAddress,
            'service_price' => random_int(0, 1000),
            'start_time' =>  $this->faker->dateTimeBetween('01.01.2022', '31.12.2025')
        ];
    }
}
