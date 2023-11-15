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
        $data = [
            'category_id' => 1,
            'unit_id' => 1,
            'name' => 'Minyak Goreng',
            'selling_price' => 15000,
            'qty_available' => '40',
        ];

        Product::create($data);
    }
}
