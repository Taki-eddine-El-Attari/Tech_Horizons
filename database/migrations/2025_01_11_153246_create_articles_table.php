<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crée la table 'articles'
    public function up(): void
    {        
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('extrait');  
            $table->text('contenu');
            $table->string('image');
            $table->timestamps();
        });
    }

    // Supprime la table 'articles'
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
