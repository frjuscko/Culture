<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['libelle' => 'Administrateur'] );
        Role::create(['libelle' => 'Modérateur'] );
        Role::create(['libelle' => 'Contributeur'] );
        Role::create(['libelle' => 'Lecteur'] );
    }
}
