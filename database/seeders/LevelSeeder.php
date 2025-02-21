<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create([
            'name' => 'Introducción'
        ]);
        Level::create([
            'name' => 'Intermedio'
        ]);
        Level::create([
            'name' => 'Avanzado'
        ]);
        Level::create([
            'name' => 'Especialización'
        ]);
        Level::create([
            'name' => 'Formación Continua'
        ]);
        Level::create([
            'name' => 'Seminarios'
        ]);
    }
}
