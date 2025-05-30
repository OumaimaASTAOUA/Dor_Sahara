<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = [
            'Dar Couscous',
            'Le Tajine Royal',
            'Pastilla Palace',
            'Salade Saha',
            'Fekkas Gourmand',
            'Cornes d’Or',
        ];

        foreach ($restaurants as $restaurantName) {
            $restaurant = Restaurant::create([
                'name' => $restaurantName,
                'category_id' => \App\Models\Category::first()->id, // Dynamic category ID
                'description' => 'Un restaurant marocain traditionnel.',
                'address' => 'Laâyoune, Maroc',
                'phone' => '06' . rand(10000000, 99999999),
                'email' => strtolower(str_replace(' ', '_', $restaurantName)) . '@example.com',
            ]);

            $this->addMenus($restaurant->id);
        }
    }

    private function addMenus($restaurantId): void
    {
        Menu::factory()->count(3)->create([
            'restaurant_id' => $restaurantId,
        ]);
    }
}
