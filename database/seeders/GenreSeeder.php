<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Action', 'Biography', 'Crime', 'Family', 'Horror', 'Romance', 'Sports',
            'War', 'Adventure', 'Comedy', 'Documentary', 'Fantasy', 'Thriller',
            'Animation', 'Costume', 'Drama', 'History', 'Musical', 'Psychological',
        ];

        // id berurutan 1..19 (sesuai genre_id pada database/data/movies.csv)
        foreach ($names as $i => $name) {
            Genre::create(['id' => $i + 1, 'name' => $name]);
        }
    }
}
