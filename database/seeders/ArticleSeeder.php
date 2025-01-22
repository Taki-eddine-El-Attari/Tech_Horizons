<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Numero;
use App\Models\Statut;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = Theme::all();
        $status = Statut::all();
        $numeros = Numero::all();
        $users = User::all();
        
        Article::factory(40)
        
        ->sequence(fn () => [
            'theme_id' => $themes->random(), // un theme au hasard
        ]) 
        ->sequence(fn () => [
            'numero_id' => $numeros->random(), // un numero au hasard
        ]) 
        ->sequence(fn () => [
            'statut_id' => $status->random(), // un statut au hasard
        ]) 
        ->hascommentaire(5, fn() => ['user_id' => $users->random()]) // 5 commentaires par article
        

        ->create(); // Créer 40 articles
    }
}
