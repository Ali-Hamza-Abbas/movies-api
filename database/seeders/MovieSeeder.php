<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run()
    {
        // Seed multiple movies
        $movies = [
            [
                'name' => 'The Titanic',
                'casts' => json_encode(['DiCaprio', 'Kate Winslet']),
                'release_date' => '1998-01-18',
                'director' => 'James Cameron',
                'imdb_rating' => 7.8,
                'rotten_tomatoes_rating' => 8.2,
            ],
            // Add more movie data as needed
        ];

        // Create movies
        foreach ($movies as $movieData) {
            Movie::create($movieData);
        }
    }
}
