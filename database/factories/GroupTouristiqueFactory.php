<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GroupTouristiqueFactory extends Factory
{
    protected $model = \App\Models\GroupTouristique::class;

    public function definition()
    {
        // Define local images with full asset URLs
        $localImages = [
            asset('images/dest1.jpg'),
            asset('images/dest2.jpg'),
            asset('images/dest3.jpg'),
            asset('images/dest4.jpg'),
            asset('images/dest5.jpg'),
            asset('images/dest6.jpg'),
            asset('images/dest7.jpg'),
        ];

        // Ensure at least one image is selected
        $selectedImages = $this->faker->randomElements($localImages, $this->faker->numberBetween(1, count($localImages)));
        if (empty($selectedImages)) {
            $selectedImages = [asset('images/placeholder.jpg')];
        }

        return [
            'title' => $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(3),
            'duration' => $this->faker->randomElement(['2 jours', '3 jours', '5 jours', '1 semaine']),
            'max_people' => $this->faker->numberBetween(5, 25),
            'starting_point' => 'Laâyoune',
            'caravan_name' => $this->faker->randomElements(['Chameaux', '4x4', 'Minibus', 'Quad'], $this->faker->numberBetween(1, 3)),
            'images' => $selectedImages, // Store as array
            'registration_link' => 'https://example.com/reservation/' . $this->faker->uuid(),
            'social_media_links' => [
                'facebook' => 'https://facebook.com/' . $this->faker->userName(),
                'instagram' => 'https://instagram.com/' . $this->faker->userName(),
            ],
            'price' => $this->faker->numberBetween(500, 2000),
        ];
    }
}
