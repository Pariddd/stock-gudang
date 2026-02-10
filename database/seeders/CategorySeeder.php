<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Alat Tulis'],
            ['name' => 'Elektronik'],
            ['name' => 'Bahan Bangunan'],
            ['name' => 'Peralatan Kantor'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
