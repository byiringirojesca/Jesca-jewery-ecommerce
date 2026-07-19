<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 2, 'name' => 'Necklaces & Pendants', 'slug' => 'necklaces-pendants'],
            ['id' => 3, 'name' => 'Rings & Bracelets', 'slug' => 'rings-bracelets'],
            ['id' => 4, 'name' => 'Dresses & Tops', 'slug' => 'dresses-tops'],
        ];

        foreach ($categories as $category) {
            // updateOrCreate prevents duplicate entry errors if you run this multiple times
            Category::updateOrCreate(
                ['id' => $category['id']], 
                [
                    'name' => $category['name'],
                    'slug' => $category['slug']
                ]
            );
        }
    }
}