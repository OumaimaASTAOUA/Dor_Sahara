<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Apartment;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Apartment::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Appartement Standard',
                'Studio Moderne',
                'Appartement Familial',
                'Loft Urbain',
                'Appartement Confort',
            ]),
            'description' => $this->faker->paragraph(2),
            'location' => 'Laâyoune, Maroc',
            'price' => $this->faker->randomFloat(2, 300, 1000),
            'rating' => $this->faker->randomFloat(1, 3.0, 4.8),
            'availability' => $this->faker->boolean(85),
            'status' => $this->faker->randomElement(['Actif', 'Inactif']),
            'link' => $this->faker->randomElement([
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'https://images.unsplash.com/photo-1484154218962-a197022b5858?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            ]),
        ];
    }

}
