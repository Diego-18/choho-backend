<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::firstOrCreate([
            'nit' => '1234567890',
            'name' => 'Cliente 1',
            'type' => 1,
            'active' => 1,
        ]);

        Customer::firstOrCreate([
            'nit' => '2234567890',
            'name' => 'Cliente 2',
            'type' => 1,
            'active' => 1,
        ]);

        Customer::firstOrCreate([
            'nit' => '3234567890',
            'name' => 'Cliente 3',
            'type' => 1,
            'active' => 1,
        ]);
    }
}
