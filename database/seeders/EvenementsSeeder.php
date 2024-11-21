<?php

namespace Database\Seeders;

use App\Models\Evenements;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvenementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Evenements::factory(1)->create();
    }
}
