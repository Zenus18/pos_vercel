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
            'name' => 'Indomie Goreng Kuah',
            'selling_price' => 5000,
            'qty_available' => '50',
        ];

        Product::create($data);
    }
}
