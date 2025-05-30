<?php

namespace Database\Factories;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

public function definition(): array
{
    return [
        'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
        'name' => $this->faker->words(2, true),
        'description' => $this->faker->sentence(),
        'price' => $this->faker->randomFloat(2, 20, 100),
        'image' => 'menus/default.jpg',
    ];
}

}
