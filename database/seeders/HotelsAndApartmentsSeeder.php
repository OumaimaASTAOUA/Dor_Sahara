<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Hotel;
use App\Models\Image;
use Illuminate\Database\Seeder;

class HotelsAndApartmentsSeeder extends Seeder
{
    public function run(): void
{
    // Seed des Hôtels
    $hotels = [
        [
            'name' => 'Hôtel Oasis',
            'description' => 'Un hôtel charmant situé au cœur de Laâyoune.',
            'location' => 'Centre-ville',
            'price' => 120,
            'status' => 'Actif',
            'link' => 'https://dor-sahara.fr/reservation/hotel-oasis',
            'images' => [
                'https://images.unsplash.com/photo-1600585154340-be6161a56a0c', // lobby
                'https://images.unsplash.com/photo-1604147706283-99d8a3ef2b02', // room
                'https://images.unsplash.com/photo-1582719478250-06d5a6c41a0c', // view
            ],
        ],
        [
            'name' => 'La Casbah',
            'description' => 'Petit hôtel traditionnel avec une ambiance saharienne.',
            'location' => 'Quartier historique',
            'price' => 80,
            'status' => 'Actif',
            'link' => 'https://dor-sahara.fr/reservation/la-casbah',
            'images' => [
                'https://images.unsplash.com/photo-1616627984391-9bfc901ccc4f',
                'https://images.unsplash.com/photo-1616627984910-e2cb84c55e1d',
            ],
        ],
        [
            'name' => 'Palais du Dune',
            'description' => 'Un hôtel luxueux avec accès direct à la plage.',
            'location' => 'Plage',
            'price' => 200,
            'status' => 'Actif',
            'link' => 'https://dor-sahara.fr/reservation/palais-du-dune',
            'images' => [
                'https://images.unsplash.com/photo-1576671081837-a22738e90a78',
                'https://images.unsplash.com/photo-1582719478141-78d6aa1ff711',
            ],
        ],
    ];

    foreach ($hotels as $hotelData) {
        $images = $hotelData['images'];
        unset($hotelData['images']);
        $hotel = Hotel::create($hotelData);
        foreach ($images as $image) {
            $hotel->images()->create(['path' => $image]);
        }
    }
}
}
