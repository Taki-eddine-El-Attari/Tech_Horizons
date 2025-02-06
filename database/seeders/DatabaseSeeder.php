<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Exécute les seeders et crée des utilisateurs
    public function run(): void
    {
        $this->call([
            ThemeSeeder::class,
            NumeroSeeder::class,
            StatutSeeder::class,
            ArticleSeeder::class,
        ]);
        
        // Crée 10 utilisateurs avec la factory
        User::factory(10)->create();
        
        // Créer un utilisateur pour les tests
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com', 
            ]);
        }
    }
}
