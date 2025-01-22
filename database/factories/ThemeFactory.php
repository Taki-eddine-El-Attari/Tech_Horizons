<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ThemeFactory extends Factory
{
    public function definition(): array
    {
        $created_at = fake()->dateTimeBetween('2024-11-01', '2025-01-01');
        $name = fake()->unique()->words(2, true);
        return [
            'couleur' => fake()->safeHexColor,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
