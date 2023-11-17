<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'is_discount_active' => true,
            'is_discount_percentage' => true,
            'discount' => 5,
        ];
        Discount::create($data);
    }
}
