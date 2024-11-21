<?php

namespace Database\Seeders;

use App\Models\Gallerie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Gallerie::factory(40)->create();
    }
}
