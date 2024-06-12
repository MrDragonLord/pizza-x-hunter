<?php

namespace Database\Factories;

use App\Models\Positions;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionsFactory extends Factory
{
    protected $model = Positions::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomNumber(2, 1),
            'description' => $this->faker->sentence,
            'weight' => $this->faker->randomNumber(2, 1),
            'discount' => $this->faker->numberBetween(0, 100),
        ];
    }
}
