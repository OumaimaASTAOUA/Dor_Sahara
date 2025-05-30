<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    protected $model = \App\Models\Destination::class;

    public function definition()
{
    $imageFilenames = [
        'Pdest.jpeg',
        'Pdest1.jpeg',
        'Pdest2.jpeg',
        'Pdest3.jpeg',
        'Pdest4.jpeg',
        'Pdest5.jpeg',
        'Pdest6.jpeg',
        'Pdest7.jpeg',
        'Pdest8.jpeg',
        'Pdest9.jpeg',
        'Pdest10.jpeg',
        'Pdest11.jpeg',
    ];

    // public/images/... => accessible from /images/...
    $imageUrls = collect($imageFilenames)
        ->map(fn($filename) => asset('images/' . $filename))
        ->shuffle()
        ->take(3) // مثلاً خذ 3 صور عشوائية
        ->values()
        ->toArray();

    return [
        'title' => $this->faker->sentence(3),
        'description' => $this->faker->paragraph(4),
        'images' => json_encode($imageUrls),
        'location' => 'https://www.google.com/maps/embed?...', // خليه كما هو أو غيّره حسب الحاجة
        'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
    ];
}

}
