<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crée la table 'statuts'
    public function up(): void
    {
        Schema::create('statuts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    // Supprime la table 'statuts'
    public function down(): void
    {
        Schema::dropIfExists('statuts');
    }
};
