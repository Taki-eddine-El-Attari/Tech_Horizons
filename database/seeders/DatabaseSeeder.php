<?php

namespace Database\Seeders;

use App\Models\Statut;
use App\Models\User;
use App\Models\Responsable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Exécuter ThemeSeeder en premier
        $this->call([
            ThemeSeeder::class,
            NumeroSeeder::class,
            StatutSeeder::class,
        ]);

        User::factory(7)->create();
        
        // Créer un utilisateur pour les tests
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com', 
            ]);
        }

        // Enfin, créer les articles
        $this->call([
            ArticleSeeder::class,
        ]);
    }
}
