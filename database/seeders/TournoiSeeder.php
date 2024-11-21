<?php

namespace Database\Seeders;

use App\Models\Calendrier_national;
use App\Models\Calendrier_regional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TournoiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calendrier_national::factory(10)->create();
        Calendrier_regional::factory(8)->create();
    }
}
