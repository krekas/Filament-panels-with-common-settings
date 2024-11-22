<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'name'         => $this->faker->words(asText: true),
            'address'      => $this->faker->address(),
            'description'  => $this->faker->text(),
            'is_published' => $this->faker->boolean(),
        ];
    }
}
