<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class ThemeSeeder extends Seeder
{

    //use HasFactory;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = collect(['Intelligence artificielle', 'Internet des objets', 'Cybersécurité', 'Réalité virtuelle' ,'Blockchain']);
        $themes->each(function ($theme) {

            $slug = Str::slug($theme);


            $description = fake()->paragraphs(asText: true);

            if (!Theme::where('slug', $slug)->exists()) {
                Theme::create([
                    'name' => $theme,
                    'slug' => $slug,
                    'Description' => $description,
                    'couleur' => Theme::factory()->make()->couleur,
                ]);
            }
        });
    }
}
