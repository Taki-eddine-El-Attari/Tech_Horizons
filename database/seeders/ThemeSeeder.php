<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = collect(['Intelligence artificielle', 'Internet des objets', 'Cybersécurité', 'Réalité virtuelle']);
        $themes->each(function ($theme) {
            $slug = Str::slug($theme);
            if (!Theme::where('slug', $slug)->exists()) {
                Theme::create([
                    'name' => $theme,
                    'slug' => $slug,
                ]);
            }
        });
    }
}
