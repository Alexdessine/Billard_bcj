<?php

namespace Database\Factories;

use App\Models\Comite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comite>
 */
class ComiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Comite::class;

    public function definition(): array
    {
        return [
            //
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'fonction' => implode(', ', fake()->words(fake()->numberBetween(1,5))),
            'telephone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'image' => fake()->imageUrl,
        ];
    }
}
