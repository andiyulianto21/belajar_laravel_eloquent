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
        Product::insert([
            'id' => '1',
            'name' => 'Ayam goreng',
            'description' => 'ini ayam goreng',
            'price' => 25000,
            'stock' => 15,
            'category_id' => 'FOOD'
        ]);
    }
}
