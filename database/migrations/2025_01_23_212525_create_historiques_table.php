<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // crée la table 'historiques'
    public function up()
{
    Schema::create('historiques', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('article_id')->constrained()->onDelete('cascade');
        $table->timestamp('viewed_at')->useCurrent();
        $table->timestamps();
    });
}

    // supprime la table 'historiques'
    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};
