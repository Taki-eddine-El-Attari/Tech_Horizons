<?php

namespace Database\Seeders;

use App\Models\Numero;
use Illuminate\Database\Seeder;


class NumeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numeros = collect(['1', '2', '3','4','5']);
        $numeros->each(function ($numero) {
            if (!Numero::where('numero', $numero)->exists()) {
                Numero::create([
                    'numero' => $numero,
                ]);
            }
        });
    }
}
