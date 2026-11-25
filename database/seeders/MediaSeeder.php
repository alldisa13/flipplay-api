<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Media::create(['type' => 'anime', 'title' => 'Sousou no Frieren', 'year' => 2023, 'rating' => 9.3, 'episodes' => 28, 'studio' => 'Madhouse']);
        Media::create(['type' => 'anime', 'title' => 'Naruto', 'year' => 2002, 'rating' => 8.0, 'episodes' => 220, 'studio' => 'Pierrot']);
        Media::create(['type' => 'film', 'title' => 'Kimi no Na wa', 'year' => 2016, 'rating' => 8.9, 'duration' => 107, 'director' => 'Makoto Shinkai']);
        Media::create(['type' => 'film', 'title' => 'Spirited Away', 'year' => 2001, 'rating' => 8.8, 'duration' => 125, 'director' => 'Hayao Miyazaki']);

        User::create(['name' => 'Andi']);
        User::create(['name' => 'Budi']);
    }
}
