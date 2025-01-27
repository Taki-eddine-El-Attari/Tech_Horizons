<?php

namespace Database\Factories;

use App\Enumérations\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
