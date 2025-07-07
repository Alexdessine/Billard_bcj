<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
     */
    public function definition()
    {
        $disciplines = [
            1 => 'blackball',
            2 => 'carambole',
            3 => 'snooker',
            4 => 'americain',
        ];

        $disciplineId = $this->faker->numberBetween(1, 4);
        $disciplineName = $disciplines[$disciplineId];

        // Générer un fichier PDF ou Word
        $title = $this->faker->sentence(3);
        $fileName = Str::slug($title) . '.' . (rand(0,1) ? 'pdf' : 'docx');
        $filePath = "public/pdf/{$disciplineName}/{$fileName}";

        // Générer un faux fichier avec du texte
        $content = "Ceci est un fichier générer aléatoirement pour {$title}.";
        Storage::disk('public')->put("pdf/{$disciplineName}/{$fileName}", $content);

        return [
            'title' => $title,
            'discipline' => $disciplineId,
            'file' => "pdf/{$disciplineName}/{$fileName}",
        ];  
    }
}
