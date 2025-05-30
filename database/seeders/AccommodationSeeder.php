<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Hotel;

class AccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 hotels
        Hotel::factory()->count(5)->create([
            'status' => 'Actif', // Override to ensure most are active
        ]);

        // Create 5 apartments
        Apartment::factory()->count(5)->create([
            'status' => 'Actif', // Override to ensure most are active
        ]);

        // Add one inactive record for testing
        Hotel::factory()->create([
            'name' => 'Chambre Inactive',
            'status' => 'Inactif',
        ]);
        Apartment::factory()->create([
            'name' => 'Appartement Inactif',
            'status' => 'Inactif',
        ]);
    }
}
