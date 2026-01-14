<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::create(['nom' => 'Litoral', 'description' => '..', 'localisation' => 'Bénin litoral', 'superficie' => '123 km', 'population' => '10000']);
    }
}
