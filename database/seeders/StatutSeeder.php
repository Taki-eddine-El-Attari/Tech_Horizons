<?php

namespace Database\Seeders;

use App\Models\Statut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuts = collect(['Refus','En Cours','Publié']);
        
        $statuts->each(function ($statut) {
            $slug = Str::slug($statut);
            if (!Statut::where('slug', $slug)->exists()) {
                Statut::create([
                    'name' => $statut,
                    'slug' => $slug,
                ]);
            }
        });
    }
}
