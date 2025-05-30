<?php



namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::truncate();

        $categories = [
            ['name' => 'Végétarien', 'slug' => 'vegetarian'],
            ['name' => 'Sain', 'slug' => 'healthy'],
            ['name' => 'Desserts', 'slug' => 'desserts'],
            ['name' => 'Traditionnel', 'slug' => 'traditional'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}

