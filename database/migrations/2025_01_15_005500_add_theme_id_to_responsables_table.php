<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('responsables', function (Blueprint $table) {
            $table->foreign('theme_id')
                  ->references('id')
                  ->on('themes')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('responsables', function (Blueprint $table) {
            $table->dropForeign(['theme_id']);
            $table->dropColumn('theme_id');

        });
    }
};
