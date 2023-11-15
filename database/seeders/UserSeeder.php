<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'username' => 'bro',
            'password' => '123',
            'role' => 'cashier',
            'full_name' => 'Mas Bro'
        ];
        User::create($data);
    }
}
