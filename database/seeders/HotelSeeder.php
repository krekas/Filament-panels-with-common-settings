<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run()
    {
        Hotel::factory(5)
            ->hasRooms(random_int(1, 5))
            ->create();
    }
}
