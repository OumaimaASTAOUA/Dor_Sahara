<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->paragraph,
            'location' => $this->faker->address,
            'price' => $this->faker->randomFloat(2, 300, 2000),
            'rating' => $this->faker->randomFloat(1, 3, 5),
            'availability' => $this->faker->boolean,
            'image' => $this->faker->imageUrl(500, 350), 
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Hotel $hotel) {
            \App\Models\Image::factory()->count(3)->create([
                'hotel_id' => $hotel->id,
            ]);
        });
    }
}
