<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::firstOrCreate([
            'nit' => '1234567890',
            'name' => 'Sede 1',
            'phone' => '1234567890',
            'address' => 'Medellin',
            'department_id' => 2,
            'city_id' => 2,
        ]);

        Branch::firstOrCreate([
            'nit' => '2234567890',
            'name' => 'Sede 2',
            'phone' => '1234567890',
            'address' => 'Envigado',
            'department_id' => 2,
            'city_id' => 2,
        ]);

        Branch::firstOrCreate([
            'nit' => '3234567890',
            'name' => 'Sede 3',
            'phone' => '1234567890',
            'address' => 'Rio Negro',
            'department_id' => 2,
            'city_id' => 2,
        ]);
    }
}