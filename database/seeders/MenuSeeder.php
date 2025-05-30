<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Menu;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


public function run(): void
{
    $restaurants = Restaurant::all();

    foreach ($restaurants as $restaurant) {
        Menu::factory()->count(3)->create([
            'restaurant_id' => $restaurant->id,
        ]);
    }
}

}
