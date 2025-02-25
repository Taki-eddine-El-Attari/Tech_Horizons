<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // crée la table 'commentaires'
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string("contenu");
            $table->integer('note')->default(0);
            $table->foreignId('article_id')->constrained()->cascadeOnDelete(); 
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    // supprime la table 'commentaires'
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
