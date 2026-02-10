<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alatTulis = Category::where('name', 'Alat Tulis')->first();
        $elektronik = Category::where('name', 'Elektronik')->first();

        Product::create([
            'name' => 'Pulpen Pilot',
            'category_id' => $alatTulis->id,
            'stock' => 20,
            'satuan' => 'pcs',
        ]);

        Product::create([
            'name' => 'Kipas Angin',
            'category_id' => $elektronik->id,
            'stock' => 4,
            'satuan' => 'pcs',
        ]);

        Product::create([
            'name' => 'Bor',
            'category_id' => $elektronik->id,
            'stock' => 3,
            'satuan' => 'pcs',
        ]);
    }
}
