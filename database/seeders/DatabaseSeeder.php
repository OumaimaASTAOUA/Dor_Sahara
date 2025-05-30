<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use App\Models\GroupTouristique;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Destination::truncate();
        GroupTouristique::truncate();

        $this->call([
            CategorySeeder::class,
            RestaurantSeeder::class,
            MenuSeeder::class,
            DestinationSeeder::class,
            GroupTouristiqueSeeder::class,
            HotelsAndApartmentsSeeder::class,
            AdminSeeder::class,
        ]);

        Destination::factory()->count(6)->create();
        GroupTouristique::factory()->count(6)->create();
        User::factory()->count(6)->create();

        User::factory()->admin()->create();
    }
}
