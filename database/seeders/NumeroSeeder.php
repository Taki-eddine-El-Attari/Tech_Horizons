<?php

namespace Database\Seeders;

use App\Models\Numero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class NumeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numeros = collect(['1', '2', '3']);
        $numeros->each(function ($numero) {
            if (!Numero::where('numero', $numero)->exists()) {
                Numero::create([
                    'numero' => $numero,
                ]);
            }
        });
    }
}
