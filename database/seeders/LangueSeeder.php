<?php

namespace Database\Seeders;

use App\Models\Langue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Langue::create(['code' => 'Fn', 'nom' => 'Fon', 'description' => '..',]);
    }
}
