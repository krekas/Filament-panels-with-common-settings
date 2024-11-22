<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->has(
                Hotel::factory()
                    ->hasRooms(random_int(1, 3))
            )
            ->create(['email' => 'hotel@test.com'])
            ->assignRole('hotels');

        User::factory()
            ->create(['email' => 'booking@test.com'])
            ->assignRole('customers');
    }
}
