<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Ajoute la colonne 'numero_id' dans la table 'articles'
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('numero_id')->after('theme_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    // Supprime la colonne 'numero_id' et la contrainte de la table 'articles'
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['numero_id']); // Supprime la contrainte
            $table->dropColumn('numero_id'); // Supprime la colonne
        });
    }
};
