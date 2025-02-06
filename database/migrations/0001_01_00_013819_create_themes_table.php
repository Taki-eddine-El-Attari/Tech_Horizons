<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crée la table 'themes'
    public function up(): void
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('Description')->nullable();
            $table->timestamps();
        });
    }
    
    // Supprime la table 'themes'
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();// Désactive les contraintes
        Schema::dropIfExists('themes'); // Supprime la table
        Schema::enableForeignKeyConstraints(); // Réactive les contraintes
    }
};
