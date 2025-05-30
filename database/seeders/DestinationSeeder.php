<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
   public function run(): void
    {
        Destination::truncate();
        Destination::factory()->count(6)->create();
    }
}
