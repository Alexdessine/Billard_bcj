<?php

namespace Database\Factories;

use App\Models\Calendrier_regional;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CalendrierRegionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Calendrier_regional::class;
    
    public function definition(): array
    {
        $dateDebut = fake()->date('Y-m-d');
        $dateFin = date('y-m-d', strtotime($dateDebut . ' + ' . fake()->numberBetween(1,30). ' days'));

        return [
            //
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'titre' => fake()->sentence(),
            'lieu' => fake()->address(),
            'club' => fake()->company(),
            'url' => 'cv.alexandrebourlier.fr',
            'is_closed' => fake()->boolean(),
        ];
    }
}
