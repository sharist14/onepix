<?php

namespace Database\Factories;

use App\Models\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuilderFactory extends Factory
{
    protected $model = Builder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'OOO "' . $this->faker->word() . '"'
        ];
    }
}
