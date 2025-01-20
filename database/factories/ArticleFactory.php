<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titre = fake()->unique()->sentence;
        $contenu = fake()->paragraphs(asText: true); 
        $created_at = fake()->dateTimeBetween('2025-01-01', 'now');

        return [
            'titre' => $titre,
            'slug' => Str::slug($titre),
            'contenu' => $contenu,
            'extrait' => Str::limit($contenu, 150),
            'image' => fake()->imageUrl,
            'couleur' => fake()->safeHexColor,
            'notes' => fake()->randomFloat(1, 3.0, 5.0),
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
