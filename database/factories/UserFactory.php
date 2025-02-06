<?php

namespace Database\Factories;

use App\Enumérations\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;
    
    // Définit les attributs par défaut d'un utilisateur
    public function definition(): array
    {
        $role = Role::cases()[array_rand(Role::cases())];
        $attributes = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role' => $role,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];

        // Assigner un thème si c'est un Responsable
        if ($role === Role::Responsable) {
            $theme = \App\Models\Theme::inRandomOrder()->first();
            if ($theme) {
                $attributes['theme_id'] = $theme->id;
            }
        }

        return $attributes;
    }
    
    // Marque l'email comme non vérifié
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
