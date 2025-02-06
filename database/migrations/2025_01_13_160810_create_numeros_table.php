<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crée la table 'numeros'
    public function up(): void
    {
        Schema::create('numeros', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->timestamps();
        });
    }

    // Supprime la table 'numeros'
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(); // Désactive les contraintes
        Schema::dropIfExists('numeros'); // Supprime la table
        Schema::enableForeignKeyConstraints(); // Réactive les contraintes
    }
};
