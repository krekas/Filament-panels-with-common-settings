<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(2, asText: true),
            'description' => $this->faker->text(),
            'price'       => $this->faker->randomNumber(random_int(3, 5)),

            'hotel_id' => Hotel::factory(),
        ];
    }
}
