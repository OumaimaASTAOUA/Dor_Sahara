<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GroupTouristique;

class GroupTouristiqueSeeder extends Seeder
{
    public function run(): void
    {
        GroupTouristique::truncate();
        GroupTouristique::factory()->count(10)->create(); 
    }
}
