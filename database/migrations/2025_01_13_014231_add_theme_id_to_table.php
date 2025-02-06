<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Ajoute la colonne 'theme_id' dans la table 'articles'
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('theme_id')->after('id')->nullable()->constrained()->nullOnDelete();
        });
    }

    // Supprime la colonne 'theme_id' et la contrainte de la table 'articles'
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['theme_id']); // Supprime la contrainte
            $table->dropColumn('theme_id'); // Supprime la colonne
        });
    }
};
