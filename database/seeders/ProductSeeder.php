<?php

namespace Database\Seeders;

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
        Product::firstOrCreate([
            'name' => 'Caucho 12 pulgadas',
        ]);

        Product::firstOrCreate([
            'name' => 'Volante',
        ]);

        Product::firstOrCreate([
            'name' => 'Ring',
        ]);


    }
}