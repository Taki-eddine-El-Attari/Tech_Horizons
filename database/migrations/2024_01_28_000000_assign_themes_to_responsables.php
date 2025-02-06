<?php

use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    // Assigne des thèmes aux utilisateurs Responsable
    public function up(): void
    {
        $themes = Theme::all(); // Récupère tous les thèmes
        if ($themes->isNotEmpty()) {
            User::where('role', 'Responsable')
                ->whereNull('theme_id')
                ->each(function ($user) use ($themes) {
                    $user->update([
                        'theme_id' => $themes->random()->id // Assigne un thème aléatoire
                    ]);
                });
        }
    }

    // Réinitialise l'assignation des thèmes
    public function down(): void
    {
        User::where('role', 'Responsable')->update(['theme_id' => null]); // Supprime l'assignation
    }
};
